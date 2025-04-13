<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategories;
use App\Models\InventoryTransaction;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Exception;

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

    public function ViewAllSuppliers(){

        $data = Suppliers::where('isActive',1)->get();


        return view('admin.InventoryManagement.Suppliers.viewAllSuppliers', compact('data'));
    }
}
