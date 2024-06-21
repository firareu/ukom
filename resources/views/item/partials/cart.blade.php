<div class="px-2 py-2 w-full grid grid-cols-5 gap-4 border-top">
    <h6 class="font-medium text-sm col-span-2">{{ $cart->name }}</h6>
    <p class="font-bold text-xs leading-loose col-span-2">{{ $cart->qty }} x Rp. @rupiah($cart->price)</p>
    <div class="w-full flex justify-end gap-2">
        <form action="{{ route('cart.reduce', $cart) }}" method="POST">
            @csrf
            <button type="submit"
                class="w-6 text-center py-1 bg-red-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                -
            </button>
        </form>
        <form action="{{ route('cart.add', $cart) }}" method="POST">
            @csrf
            <button type="submit"
                class="w-6 text-center py-1 bg-indigo-600 text-white border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                +
            </button>
        </form>

    </div>
</div>
