<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategories;
use App\Models\InventoryTransaction;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
    public function ViewAllInventory(){


        $data = Inventory::join('inventory_categories','inventory_categories.id','=','inventories.inventory_category_id')
        ->join('suppliers','suppliers.id','=','inventories.supplier_id')
        ->select('inventories.*','inventory_categories.category','suppliers.name as supplierName')
        ->orderby('inventories.id','desc')
        ->where('inventories.isActive',1)
        ->get();


        return view('admin.InventoryManagement.viewAllInventory', compact('data'));
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
        ->select('inventory_transactions.*','inventories.*','inventory_categories.*','suppliers.*')
        ->orderby('inventory_transactions.id','desc')
        ->get();


        return view('admin.InventoryManagement.Transactions.viewAllTransactions', compact('data'));


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
