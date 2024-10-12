<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de controle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    {{ __("Você está logado!") }}
                    
                    <!--Exibição do saldo de anisiocoins-->
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-800">
                            {{ __('Seu saldo de anisiocoins:') }}
                        </h3>
                        <p class="text-xl text-green-600">
                            {{ $user->wallet ? $user->wallet->balance : 0 }} anisiocoins
                        </p>
                    </div>

                    <!-- Exibição da ID do usuário -->
                    <div class="mt-4">
                        <h3 class="text-lg font-medium text-gray-800">
                            {{ __('Sua ID de usuário:') }}
                        </h3>
                        <p class="text-lg text-gray-800">
                            {{ $user->id }}
                        </p>
                    </div>

                    <!-- Formulário de transferência de anisiocoins -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800">
                            {{ __('Transferir anisiocoins') }}
                        </h3>
                        <form action="{{ route('transfer') }}" method="POST" class="mt-4">
                            @csrf
                            <div>
                                <label for="recipient_id" class="block text-sm font-medium text-gray-700">ID do destinatário:</label>
                                <input type="number" name="recipient_id" id="recipient_id" class="mt-1 block w-full" required>
                            </div>
                            <div class="mt-4">
                                <label for="amount" class="block text-sm font-medium text-gray-700">Quantidade de anisiocoins:</label>
                                <input type="number" name="amount" id="amount" class="mt-1 block w-full" required>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded">Transferir</button>
                            </div>
                        </form>

                        @if (session('success'))
    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




