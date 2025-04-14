<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategories;
use App\Models\InventoryTransaction;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{

    //Inventory Management
    //view all inventories
    public function ViewAllInventory(){


        $data = Inventory::join('inventory_categories','inventory_categories.id','=','inventories.inventory_category_id')
        ->join('suppliers','suppliers.id','=','inventories.supplier_id')
        ->select('inventories.*','inventory_categories.category','suppliers.name as supplierName')
        ->orderby('inventories.id','desc')
        ->where('inventories.isActive',1)
        ->get();

        $categories = InventoryCategories::where('isActive',1)->get();
        $suppliers = Suppliers::where('isActive',1)->get();


        return view('admin.InventoryManagement.viewAllInventory', compact('data','categories','suppliers'));
    }

    //add new inventory

    public function AddInventory(Request $request){

        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|decimal:0,2',
            'supplier' => 'required',
            'sku' => 'required | integer | min:0',
        ],[
            'category.required' => 'Please select a category.',
            'name.required' => 'Please enter a name.',
            'quantity.required' => 'Please enter a quantity.',
            'quantity.numeric' => 'Please enter a valid quantity.',
            'quantity.min' => 'Please enter a valid quantity.',
            'price.required' => 'Please enter a price.',
            'price.numeric' => 'Please enter a valid price.',
            'price.decimal' => 'Please enter a valid price.',
            'supplier.required' => 'Please select a supplier.',
            'sku.required' => 'Please enter a quantity.',
            'sku.min' => 'Please enter a valid quantity.',
        ]);

        if($request->quantity > $request->sku){
            return back()
                ->withErrors([
                    'quantity' => 'Quantity cannot be greater than SKU.',
                ])
                ->withInput();
        }

        try{
            DB::beginTransaction();

            $inventory = new Inventory();
            $inventory->inventory_category_id = $request->category;
            $inventory->name = $request->name;
            $inventory->description = $request->description;
            $inventory->quantity = $request->quantity;
            $inventory->price = $request->price;
            $inventory->supplier_id = $request->supplier;
            $inventory->sku = $request->sku;
            $inventory->reorder_level = $request->sku - $request->quantity;
            $inventory->isActive = 1;
            $inventory->save();

            $transaction = new InventoryTransaction();
            $transaction->inventory_id = $inventory->id;
            $transaction->transaction_type = 'Add New';
            $transaction->quantity = $request->quantity;
            $transaction->reference = Auth::user()->id;
            $transaction->note = 'New Inventory Record added by '.Auth::user()->name;
            $transaction->save();

            DB::commit();

            return redirect()->back()->with('message','Inventory added successfully.');

        }catch(Exception $e){

            return redirect()->back()->with('error','Something went wrong.');

        }
    }

    //edit inventory

    public function EditInventory(Request $request){

        $request->validate([
            'id' => 'required',
            'ecategory' => 'required',
            'ename' => 'required',
            'edescription' => 'nullable',
            'equantity' => 'required|integer|min:0',
            'eprice' => 'required|numeric|decimal:0,2',
            'esupplier' => 'required',
            'esku' => 'required | integer | min:0',
        ],[
            'ecategory.required' => 'Please select a category.',
            'ename.required' => 'Please enter a name.',
            'equantity.required' => 'Please enter a quantity.',
            'equantity.numeric' => 'Please enter a valid quantity.',
            'equantity.min' => 'Please enter a valid quantity.',
            'eprice.required' => 'Please enter a price.',
            'eprice.numeric' => 'Please enter a valid price.',
            'eprice.decimal' => 'Please enter a valid price.',
            'esupplier.required' => 'Please select a supplier.',
            'esku.required' => 'Please enter'
        ]);

        if($request->esku < $request->equantity){
            return back()
                ->withErrors([
                    'equantity' => 'Quantity cannot be greater than SKU.',
                ])
                ->withInput();
        }

        try{

            $inventory = Inventory::find($request->id);

            if(!$inventory || $inventory->isActive == 0){

                return redirect()->back()->with('error','Inventory not found.');
            }

            DB::beginTransaction();

            $inventory->where('id',$request->id)->update([
                'inventory_category_id' => $request->ecategory,
                'name' => $request->ename,
                'description' => $request->edescription,
                'quantity' => $request->equantity,
                'price' => $request->eprice,
                'supplier_id' => $request->esupplier,
                'sku' => $request->esku,
                'reorder_level' => $request->esku - $request->equantity
            ]);

            $transaction = new InventoryTransaction();
            $transaction->inventory_id = $inventory->id;
            $transaction->transaction_type = 'Edit Record';
            $transaction->quantity = abs($inventory->quantity - $request->equantity);
            $transaction->reference = Auth::user()->id;
            $transaction->note = 'Inventory Record updated by '.Auth::user()->name;
            $transaction->save();

            DB::commit();

            return redirect()->back()->with('message','Inventory updated successfully.');

        }catch(Exception $e){

            return redirect()->back()->with('error','Something went wrong.');

        }

    }

    //delete inventory

    public function DeleteInventory(Request $request){

        $request->validate([
            'id' => 'required',
        ],[
            'id.required' => 'Please select an inventory.',
        ]);

        try{

            $inventory = Inventory::find($request->id);

            if(!$inventory || $inventory->isActive == 0){

                return redirect()->back()->with('error','Inventory not found.');
            }
            DB::beginTransaction();

            $inventory->where('id',$request->id)->update([
                'isActive' => 0,
            ]);

            $transaction = new InventoryTransaction();
            $transaction->inventory_id = $inventory->id;
            $transaction->transaction_type = 'Delete Record';
            $transaction->quantity = $inventory->quantity;
            $transaction->reference = Auth::user()->id;
            $transaction->note = 'Inventory Record deleted by '.Auth::user()->name;
            $transaction->save();

            return redirect()->back()->with('message','Inventory deleted successfully.');

        }catch(Exception $e){

            return redirect()->back()->with('error','Something went wrong.');
        }
    }



    //Inventory Categories
    //view all category

    public function ViewAllCategory(){

        $data = InventoryCategories::where('isActive',1)->get();

        return view('admin.InventoryManagement.Categories.viewAllCategory', compact('data'));
    }


    //add new category

    public function AddCategory(Request $request){

        $request->validate([
            'category' => 'required',
            'description' => 'nullable',
        ],[
            'category.required' => 'Please enter a category name.',

        ]);

        try{

            $category = new InventoryCategories();
            $category->category = $request->category;
            $category->description = $request->description;
            $category->isActive = 1;
            $category->save();

            return redirect()->back()->with('message','Category added successfully.');

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong. Please try again later.');
        }
    }

    //edit category

    public function EditCategory(Request $request){

        $request->validate([
            'id' => 'required',
            'ecategory' => 'required',
            'edescription' => 'nullable',
        ],[
            'ecategory.required' => 'Please enter a category name.',
            'id.required' => 'Please select a category.',
        ]);

        try{

            $category = InventoryCategories::find($request->id);

            if(!$category || $category->isActive == 0){
                return redirect()->back()->with('error','Category not found.');
            }

            $category->update([
                'category' => $request->ecategory,
                'description' => $request->edescription,
            ]);

            return redirect()->back()->with('message','Category updated successfully.');

        }catch(Exception $e){

            return redirect()->back()->with('error','Something went wrong. Please try again later.');
        }


    }

    //delete category

    public function DeleteCategory(Request $request){

        $request->validate([
            'id' => 'required',
        ],[
            'id.required' => 'Please select a category.',
        ]);

        try{

            $category = InventoryCategories::find($request->id);

            if(!$category || $category->isActive == 0){
                return redirect()->back()->with('error','Category not found.');
            }

            $category->update([
                'isActive' => 0,
            ]);

            return redirect()->back()->with('message','Category deleted successfully.');


        }catch(Exception $e){

            return redirect()->back()->with('error','Something went wrong. Please try again later.');
        }
    }
    public function ViewAllTransactions(){

        $data = InventoryTransaction::join('inventories','inventory_transactions.inventory_id','=','inventories.id')
        ->join('inventory_categories','inventory_categories.id','=','inventories.inventory_category_id')
        ->join('suppliers','suppliers.id','=','inventories.supplier_id')
        ->select('inventory_transactions.*','inventories.name as iname')
        ->orderby('inventory_transactions.id','desc')
        ->get();


        return view('admin.InventoryManagement.Transactions.viewAllTransactions', compact('data'));


    }

    //make a transaction

    public function MakeTransaction(Request $request){

        // dd($request->all());

        $request->validate([
            'id' => 'required',
            'ttransaction' => 'required',
            'tquantity' => 'required | integer | min:1',
            'tnote' => 'required',
        ],[
            'id.required' => 'Please select an inventory.',
            'ttransaction.required' => 'Please select a transaction type.',
            'tquantity.required' => 'Please enter a quantity.',
            'tquantity.integer' => 'Please enter a valid quantity.',
            'tquantity.min' => 'Please enter a quantity greater than 0.',
            'tnote.required' => 'Please enter a note.',
        ]);

        try{

            $inventory = Inventory::find($request->id);

            if(!$inventory || $inventory->isActive == 0){
                return redirect()->back()->with('error','Inventory not found.');
            }

            if($request->tquantity > $inventory->quantity){

                return back()
                ->withErrors([
                    'tquantity' => 'Quantity is greater than available quantity, available quantity is '.$inventory->quantity.'.',
                ])
                ->withInput();
            }

            DB::beginTransaction();

            $transaction = new InventoryTransaction();
            $transaction->inventory_id = $request->id;
            $transaction->transaction_type = $request->ttransaction;
            $transaction->quantity = $request->tquantity;
            $transaction->reference = Auth::user()->id;
            $transaction->note = "note : " .$request->tnote . ". by " . Auth::user()->name;
            $transaction->save();

            $inventory->quantity = $inventory->quantity - $request->tquantity;
            $inventory->save();

            $inventory->update([
                'reorder_level' => $inventory->sku - $inventory->quantity,
            ]);

            DB::commit();

            return redirect()->back()->with('message','Transaction made successfully.');

        }catch(Exception $e){

            DB::rollback();
            return redirect()->back()->with('error','Something went wrong. Please try again later.');

        }

    }

    //suppliers
    //view all suppliers
    public function ViewAllSuppliers(){

        $data = Suppliers::where('isActive',1)->get();


        return view('admin.InventoryManagement.Suppliers.viewAllSuppliers', compact('data'));
    }

    //add supplier
    public function AddSupplier(Request $request){


        $request->validate([
            'name' => 'required | unique:suppliers,name',
            'contact_person' => 'required',
            'email' => 'required | email |unique:suppliers,email',
            'phone' => 'required | numeric | digits:10 | unique:suppliers,phone',
            'address' => 'required',
        ],[
            'name.required' => 'Please enter a supplier Company name.',
            'name.unique' => 'Supplier Company name already exists.',
            'contact_person.required' => 'Please enter a contact person name.',
            'email.required' => 'Please enter a email.',
            'email.unique' => 'Email already exists.',
            'email.email' => 'Please enter a valid email.',
            'phone.required' => 'Please enter a phone number.'
            ,'phone.numeric' => 'Please enter a valid phone number.',
            'phone.digits' => 'Please enter a valid phone number.',
            'phone.unique' => 'Phone number already exists.',
            'address.required' => 'Please enter a address.',
        ]);

        try{

            $supplier = new Suppliers();
            $supplier->name = $request->name;
            $supplier->contact_person = $request->contact_person;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->isActive = 1;
            $supplier->save();

            return redirect()->back()->with('message','Supplier added successfully.');

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong. Please try again later.');
        }
    }

    //edit supplier

    public function EditSupplier(Request $request){

        $request->validate([
            'id' => 'required',
            'econtact_person' => 'required',
            'eemail' => ['required', 'email', Rule::unique('suppliers', 'email')->ignore($request->id)],
            'ephone' => ['required', 'numeric', 'digits:10', Rule::unique('suppliers', 'phone')->ignore($request->id)],
            'ename'  => ['required', Rule::unique('suppliers', 'name')->ignore($request->id)],
            'eaddress' => 'required',
        ],[
            'id.required' => 'Please select a supplier.',
            'ename.required' => 'Please enter a supplier Company name.',
            'ename.unique' => 'Supplier Company name already exists.',
            'econtact_person.required' => 'Please enter a contact person name.',
            'eemail.required' => 'Please enter a email.',
            'eemail.email' => 'Please enter a valid email.',
            'eemail.unique' => 'Email already exists.',
            'ephone.required' => 'Please enter a phone number.',
            'ephone.numeric' => 'Please enter a valid phone number.',
            'ephone.digits' => 'Please enter a valid phone number.',
            'ephone.unique' => 'Phone number already exists.',
            'eaddress.required' => 'Please enter a address.',
        ]);

        try{

            $supplier = Suppliers::find($request->id);

            if(!$supplier || $supplier->isActive == 0){
                return redirect()->back()->with('error','Supplier not found.');
            }

            $supplier->update([
                'name' => $request->ename,
                'contact_person' => $request->econtact_person,
                'email' => $request->eemail,
                'phone' => $request->ephone,
                'address' => $request->eaddress,
            ]);

            return redirect()->back()->with('message','Supplier updated successfully.');

        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong. Please try again later.');
        }

    }
    //delete supplier

    public function DeleteSupplier(Request $request){


        $request->validate([
            'id' => 'required',
        ],[
            'id.required' => 'Please select a supplier.',
        ]);

        try{
            $supplier = Suppliers::find($request->id);

            if(!$supplier || $supplier->isActive == 0){
                return redirect()->back()->with('error','Supplier not found.');
            }

            $supplier->where('id',$request->id)->update([
                'isActive' => 0,
            ]);

            return redirect()->back()->with('message','Supplier deleted successfully.');

        }catch(Exception $e){

            return redirect()->back()->with('error','Something went wrong. Please try again later.');
        }
    }
}
