<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Invoice;
use App\Models\PaymentHistory;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    /**
     * Display a listing of the shops.
     */
    public function index(Request $request)
    {
        $query = Shop::query()->latest();

        $search = trim((string) $request->input('search'));
        
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                  ->orWhere('shop_name', 'like', '%' . $search . '%')
                  ->orWhere('shop_address', 'like', '%' . $search . '%')
                  ->orWhere('mobile_number', 'like', '%' . $search . '%')
                  ->orWhere('due_amount', 'like', '%' . $search . '%');
            });
        }
        
        $shops = $query->paginate(10)->appends(['search' => $search]);
        return view('Admin.shops.index', compact('shops'));
    }

    /**
     * Show the form for creating a new shop.
     */
    public function create()
    {
        return view('Admin.shops.create');
    }

    /**
     * Store a newly created shop in storage.
     */
    /**
     * Generate a sequential 3-digit ID
     */
    protected function generateUniqueShopId()
    {
        // Get the highest existing shop_id and increment by 1
        $lastShop = \App\Models\Shop::orderBy('shop_id', 'desc')->first();
        $nextId = $lastShop ? ((int)$lastShop->shop_id + 1) : 1;
        
        // Ensure the ID doesn't exceed 999
        if ($nextId > 999) {
            throw new \Exception('Maximum number of shops (999) reached');
        }
        
        return str_pad($nextId, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Store a newly created shop in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate(array_merge(Shop::$rules, [
            'due_amount' => 'nullable|numeric|min:0|max:99999999.99',
        ]));
        try{
        // Generate a unique 3-digit ID
        // $validated['shop_id'] = $this->generateUniqueShopId();
        
        // Set default due amount to 0 if not provided
        $validated['due_amount'] = $validated['due_amount'] ?? 0;
        
        
        $shop=Shop::create($validated);
        if(!empty($validated['due_amount']) &&$validated['due_amount'] > 0){
            $data=[
                'shop_id'=>$shop->id,
                'paid_amount'=>0,
                'due_amount'=>$validated['due_amount'],
                'payment_from'=>'Initial due amount'
            ];
            PaymentHistory::create($data);
        }
        
        return redirect()->route('shops.index')
            ->with('success', 'Shop created successfully.');
    }
    catch(\Exception $e){
        echo"Error: " . $e->getMessage();
        exit();
    }
    }

    /**
     * Display the specified shop.
     */
    public function show(Shop $shop)
    {
        $data = PaymentHistory::where('shop_id', $shop->id)->latest()->get();
        return view('Admin.shops.show', compact('shop','data'));
    }

    /**
     * Show the form for editing the specified shop.
     */
    public function edit(Shop $shop)
    {
        $invoiceData = Invoice::where('shop_id', $shop->id)->first();
        $paymentData=PaymentHistory::where('shop_id', $shop->id)->where('paid_amount', '>', 0)->first();
        //dd($paymentData->paid_amount);
        return view('Admin.shops.edit', compact('shop','invoiceData','paymentData'));

    }

    /**
     * Update the specified shop in storage.
     */
    public function update(Request $request, Shop $shop)

    {   
        
        $invoiceData = Invoice::where('shop_id', $shop->id)->first();
        $validated = $request->validate(array_merge(Shop::$rules, [
            'due_amount' => 'nullable|numeric|min:0|max:99999999.99',
        ]));
        try{
        
        if ($invoiceData) {
            // If invoice exists, keep the previous due amount
            $validated['due_amount'] = $shop->due_amount; 
        } else {
            // If no invoice, take input from the form
            $validated['due_amount'] = $request->input('due_amount', 0);
        }

        // Set default due amount to 0 if not provided
        //$validated['due_amount'] = $validated['due_amount'] ?? 0;
        
        $shop->update($validated);
        //dd($shop->id);
        if(!empty($validated['due_amount']) &&$validated['due_amount'] > 0){
            
            $payment=PaymentHistory::where('shop_id',$shop->id)->first();
            //dd($payment);
            if(!empty($payment)){
            $data=['due_amount'=>$validated['due_amount']];
            $payment->update($data);
            }
            else{
                $data=[
                    'shop_id'=>$shop->id,
                    'paid_amount'=>0,   
                    'due_amount'=>$validated['due_amount'],
                    'payment_from'=>'Initial due amount'
                ];
            PaymentHistory::create($data);
            }
        }
        
        return redirect()->route('shops.index')
            ->with('success', 'Shop updated successfully');
    }
    catch(\Exception $e){
        echo"Error: " . $e->getMessage();
        exit();
    }
    }

    /**
     * Remove the specified shop from storage.
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        
        return redirect()->route('shops.index')
            ->with('success', 'Shop deleted successfully');
    }
    
    /**
     * Update the specified shop's due amount.
     */
    public function updateDueAmount(Request $request,Shop $shop)
    {
        $shopDue=$shop->due_amount;
        $validated = $request->validate([
            'due_amount' => 'required|numeric|min:0|max:'.$shopDue,
            'remark'=>'nullable|string|max:255'
        ]);
        try{
        // $preDue=$shop->findorFail();
        // $newDue=$preDue-$validated['due_amount'];
        // dd($newDue);
        // $shop->update([$newDue]);
        // Calculate new due amount by subtracting the payment from current due
        //dd($validated['due_amount']);
        
       if($validated['due_amount'] > $shop->due_amount){
        echo "Due amount cannot be greater than current due amount, your current due amount is ₹".$shop->due_amount;
        exit;
            
        }   
        // due amount update in invoice table 
        //DB::beginTransaction();

    
        $paymentAmount = $validated['due_amount'];
        $remainingPayment = $paymentAmount;

        // 🧾 Fetch all invoices with unpaid balance for this shop
        $invoices = Invoice::where('shop_id', $shop->id)
            ->whereRaw('(total_amount - (COALESCE(paid_amount, 0))) > 0')
            ->orderBy('created_at', 'asc')
            ->lockForUpdate()
            ->get();

        foreach ($invoices as $invoice) {
            if ($remainingPayment <= 0) break;

            // Calculate current due for this invoice dynamically
            $currentDue = $invoice->total_amount - ($invoice->paid_amount + $invoice->discount_amount);

            if ($currentDue <= 0) continue; // skip already paid invoices

            if ($currentDue <= $remainingPayment) {
                // 🟢 Full payment for this invoice
                $invoice->paid_amount += $currentDue;
                $remainingPayment -= $currentDue;
            } else {
                // 🟡 Partial payment
                $invoice->paid_amount += $remainingPayment;
                $remainingPayment = 0;
            }

            $invoice->save();
        }
        //end due amount update in invoice table
        $newDue = $shop->due_amount - $validated['due_amount'];
        
        // Ensure the due amount doesn't go below zero
        $newDue = max(0, $newDue);
        $payment_history=[
            'shop_id'=>$shop->id,
            'paid_amount'=>$validated['due_amount'],
            'due_amount'=>$newDue,
            'payment_from'=>'Due Payment',
            'remark'=>$validated['remark'] 
        ];
        PaymentHistory::create($payment_history);
        // Update the shop's due amount
        $shop->update(['due_amount' => $newDue]);
        
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Due amount updated successfully',
        //     'due_amount' => number_format($shop->fresh()->due_amount, 2)
        // ]);
        
        $data=PaymentHistory::where('shop_id','=',$shop->id)->latest()->first();
        return redirect()->route('shops.show', compact('shop','data'))->with('success', 'Due amount updated successfully');
    }catch(\Exception $e){
        echo"Error: " . $e->getMessage();
        exit();
    }
}

    public function trashed()
    {
        $shops = Shop::onlyTrashed()->latest()->paginate(10);
        return view('Admin.shops.trashed',compact('shops'));

    }
    public function restore($id)
    {
        $shop = Shop::onlyTrashed()->findOrFail($id);
        $shop->restore();
        return redirect()->route('shops.trashed',)->with('success', 'Shop restored successfully.');
    }
    public function deletePermanently($id)
    {
        $shop = Shop::onlyTrashed()->findOrFail($id);
        $shop->forceDelete();
        return redirect()->route('shops.trashed')->with('success', 'Shop permanently deleted.');
    }
}