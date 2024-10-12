<?php
//namespace App\Http\Controllers;

//use Illuminate\Http\Request;

//class TransactionController extends Controller
//{
    //
//} 


/**namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transfer(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $fromUser = auth()->user();
        $toUser = User::find($request->to_user_id);
        $amount = $request->amount;

        $fromWallet = $fromUser->wallet;
        $toWallet = $toUser->wallet;

        if ($fromWallet->balance >= $amount) {
            $fromWallet->balance -= $amount;
            $fromWallet->save();

            $toWallet->balance += $amount;
            $toWallet->save();

            Transaction::create([
                'from_user_id' => $fromUser->id,
                'to_user_id' => $toUser->id,
                'amount' => $amount,
            ]);

            return back()->with('success', 'Transferência realizada com sucesso.');
        }

        return back()->with('error', 'Saldo insuficiente.');
    }
}
*/



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**public function transfer(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'recipient_id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ]);

        // Obtém a carteira do usuário autenticado (Ariana)
        $senderWallet = Auth::user()->wallet;

        // Verifica se o saldo é suficiente
        if ($senderWallet->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Saldo insuficiente para a transferência.']);
        }

        // Obtém a carteira do destinatário
        $recipientWallet = Wallet::where('user_id', $request->recipient_id)->first();

        // Realiza a transferência
        $senderWallet->decrement('balance', $request->amount);
        $recipientWallet->increment('balance', $request->amount);

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('dashboard')->with('success', 'Transferência realizada com sucesso!');
    
    }*/
        public function transfer(Request $request)
    {
            // Valida os dados do formulário
            $request->validate([
                'recipient_id' => 'required|integer|exists:users,id',
                'amount' => 'required|numeric|min:1',
            ]);

            // Obtém a carteira do usuário autenticado (Ariana)
            $senderWallet = Auth::user()->wallet;

            // Verifica se o saldo é suficiente
            if ($senderWallet->balance < $request->amount) {
                return back()->withErrors(['amount' => 'Saldo insuficiente para a transferência.']);
            }

            // Obtém a carteira do destinatário
            $recipientWallet = Wallet::where('user_id', $request->recipient_id)->first();

            // Verifica se a carteira do destinatário existe
            if (!$recipientWallet) {
                return back()->withErrors(['recipient_id' => 'Destinatário não encontrado ou sem carteira.']);
            }

            // Realiza a transferência
            $senderWallet->decrement('balance', $request->amount);
            $recipientWallet->increment('balance', $request->amount);

            // Redireciona com uma mensagem de sucesso
            return redirect()->route('dashboard')->with('success', 'Transferência realizada com sucesso!');
    }
}
