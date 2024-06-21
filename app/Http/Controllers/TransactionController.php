<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // check if user is admin
        if (auth()->user()->role == 'admin') { // if user is admin, query all transaction
            $transactions = Transaction::query();
        } else { // otherwise, query transaction that owned by logged user
            $transactions = $request->user()->transaction();
        }

        // display view of transaction
        return view('transaction.index', [
            'transactions' => $transactions->latest()->paginate(),
        ]);
    }

    /**
     * Show cart pages for "Keranjang Belanja" purposes
     */
    public function cart(Request $request)
    {
        // query all cart items
        $savedCart = collect($request->session()->get('cart', []));
        $carts = Item::query()->whereIn('id', $savedCart->pluck('item_id'))->get();
        $carts->each(function ($cart) use ($savedCart) {
            $cart->{'qty'} = $savedCart->firstWhere('item_id', $cart->id)->qty;
        });

        return view('transaction.cart', compact('carts'));
    }

    /**
     * Show pages that display items by category for "Halaman Produk" purposes
     */
    public function create(Request $request)
    {
        // query items
        $items = Item::query();

        // if user selected a category, filter by category
        if ($request->has('q')) {
            $items = $items->whereHas('category', fn ($q) => $q->where('name', $request->q));
        }

        // query all categories
        $categories = Category::query()->whereHas('item')->get();

        // query all cart items
        $savedCart = collect($request->session()->get('cart', []));
        $carts = Item::query()->whereIn('id', $savedCart->pluck('item_id'))->get();
        $carts->each(function ($cart) use ($savedCart) {
            $cart->{'qty'} = $savedCart->firstWhere('item_id', $cart->id)->qty;
        });

        // return view
        return view('transaction.create', [
            'items' => $items->get(),
            'categories' => $categories,
            'carts' => $carts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate user input
        $request->validate([
            'payment_method' => ['required', Rule::in(['debit', 'credit', 'cod'])]
        ]);

        DB::beginTransaction();
        try {
            // get items in cart
            $savedCart = collect($request->session()->get('cart'));

            // create new Transaction instance
            $transaction = $request->user()->transaction()->create([
                'payment_method' => $request->payment_method,
                'total' => $savedCart->sum(fn ($c) => $c->qty * $c->price)
            ]);

            // save item in cart to transaction
            $savedCart->each(function ($cart) use ($transaction) {
                $item = Item::findOrFail($cart->item_id);
                $transaction->items()->attach($item, [
                    'qty' => $cart->qty,
                    'price' => $item->price,
                ]);
            });

            // clear cart
            $request->session()->forget('cart');
            $request->session()->flush();

            // commit save to database
            DB::commit();

            return redirect()->route('transaction.index')->with('success', 'Berhasil membuat transaksi');
        } catch (Exception $e) {
            // rollback if something wrong happened
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $Transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $Transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $Transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $Transaction)
    {
        //
    }

    /**
     * Add selected item to cart
     */
    public function addCart(Item $item, Request $request)
    {
        // get existing cart
        $cart = collect($request->session()->get('cart'));

        // check if item is not on the cart, make new item in cart
        if ($cart->firstWhere('item_id', $item->id) == null) {
            $cart->push((object) [
                'item_id' => $item->id,
                'qty' => 1,
                'price' => $item->price,
            ]);
        } else { // otherwise add qty on existing cart
            $cart->firstWhere('item_id', $item->id)->qty += 1;
            $cart->firstWhere('item_id', $item->id)->price = $item->price * $cart->firstWhere('item_id', $item->id)->qty;
        }

        // save cart
        $request->session()->put('cart', $cart);
        $request->session()->save();

        // redirect back
        return redirect()->back()->with('success', 'Berhasil menambahkan barang ke keranjang');
    }

    /**
     * Reduce qty of selected item on cart
     */
    public function reduceCart(Item $item, Request $request)
    {
        // get existing cart
        $cart = collect($request->session()->get('cart'));

        // check if selected item is on the cart
        $selectedCart = $cart->firstOrFail(fn ($c) => $c->item_id == $item->id);
        $selectedCart->qty -= 1;
        $selectedCart->price = $item->price * $selectedCart->qty;


        // save cart, if qty is less than 0, delete the instance
        $request->session()->put('cart', $cart->filter(fn ($c) => $c->qty > 0));
        $request->session()->save();

        // redirect back
        return redirect()->back()->with('success', 'Berhasil menambahkan barang ke keranjang');
    }
}
