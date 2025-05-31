<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
  public function getUsersCount()
  {
      $accounts    = DB::table('accounts')->count();
      $customer    = DB::table('customer')->count();
      $transaction = DB::table('transactions')->count();
      $balance = DB::table('accounts') -> select(DB::raw('SUM(balance) as total')) -> value('total');
      $customer_ranking = DB::table("accounts")-> orderBy('balance') -> limit(10) -> get();
      $id = [];

      foreach($customer_ranking as $key => $value){
          $id[] =$value -> customer_id;

      }

      $customer_info = DB::table('accounts') -> join('customer','accounts.customer_id','=','customer.customer_id') -> get() ->whereIn('customer_id',
      [$id[0],$id[1],$id[2],$id[3],$id[4],$id[5],$id[6],$id[7],$id[8],$id[9]] );



      return response()->json(['accounts' => $accounts, 
                                    'customer' => $customer, 
                                    "transaction" => $transaction, 
                                    "balance" => $balance,
                                    'customer_ranking' => $customer_ranking,
                                    "customer_info" => $customer_info,]
                                );
    } 


    public function getAccountInfo(){


    }

  public function getTypeCount()
  {
    $basicCount    = DB::table('accounts')->where('account_type', 'Basic')->count();
    $savingsCount  = DB::table('accounts')->where('account_type', 'Checking')->count();
    $checkingCount = DB::table('accounts')->where('account_type', 'Savings')->count();

    return response()->json(["basicCount" => $basicCount,
    "savingsCount" => $savingsCount, 'checkingCount' => $checkingCount]);

  }

  public function getStatusCount()
  {
    $activeCount   = DB::table('accounts')->where('status', '1')->count();
    $inactiveCount = DB::table('accounts')->where('status', '0')->count();

    return response()->json([
    'active' => $activeCount, 'inactive' => $inactiveCount,
    ]);

    }

  public function getDataByType()
  {
    $type1    = "Basic";
    $type2    = "Foreign Currency";
    $type3    = "Savings";  
    $type4    = "Checking";

    
    $basic    = DB::table('accounts')->sum('balance')->where('account_type', $type1)->get();
    $foreign  = DB::table('accounts')->sum('balance')->where('account_type', $type2)->get();
    $savings  = DB::table('accounts')->sum('balance')->where('account_type', $type3)->get();
    $checking = DB::table('accounts')->sum('balance')->where('account_type', $type4)->get();

    return response()->json([
    "basicAccount" => $basic,
    "foreignAccount" => $foreign,
    "savingsAccount" => $savings,
    "checkingAccount" => $checking,
    ]);

  }
  }
