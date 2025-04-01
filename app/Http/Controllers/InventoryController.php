<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryCategories;
use App\Models\InventoryTransaction;
use App\Models\Suppliers;
use Illuminate\Http\Request;

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

    public function ViewAllCategory(){

        $data = InventoryCategories::where('isActive',1)->get();

        return view('admin.InventoryManagement.Categories.viewAllCategory', compact('data'));
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
