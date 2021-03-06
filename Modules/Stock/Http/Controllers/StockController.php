<?php

namespace Modules\Stock\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
Use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Modules\User\Entities\User;
use Modules\Stock\Entities\Stock;
use Modules\Stock\Entities\StockTransaction;

class StockController extends Controller
{
    public function __construct(){
        $this->configKey = "APSD";
        $this->header = \Request::header('access_token');

    }

    public function index(){
        return view("stock::index");
    }
    
    public function create(Request $request){
        
        $access_token = $request->header('access_token');
        if ( $request->header('access_token') != "" ){
            try{
                $namaBarang = $request->nama_barang;
                $sku = $request->sku;
                $stock = $request->stock;
                $createStock = new Stock;
                $createStock->name = $namaBarang;
                $createStock->sku = $sku;
                $createStock->stock = $stock;
                $createStock->created_at = date("Y-m-d H:i:s");
                $createStock->save();

                $dataAccessToken['stock_id'] = $createStock->id; 
                $dataAccessToken['nama'] = $namaBarang; 
                $dataAccessToken['sku'] = $sku; 
                $dataAccessToken['stock'] = $stock;

                $access_token = JWT::encode($dataAccessToken, $this->configKey, 'HS256');
                $response['code'] = "SUCCESS";
                $response['access_token'] = $access_token;
                echo json_encode($response);
                exit();
            }catch ( Exception $e){
                $response['code'] = "FAILED";
                $response['message'] = $e->getMessage();
                echo json_encode($response);
                exit();
            }
            
        }else{
            http_response_code(419);
            exit();
        }
        
    }

    public function view($id){
        if ( $this->header != ""){
            $dataStock = Stock::find($id);
            $dataAccessToken['stock_id'] = $dataStock->id; 
            $dataAccessToken['nama'] = $dataStock->nama; 
            $dataAccessToken['sku'] = $dataStock->sku; 
            $dataAccessToken['stock'] = $dataStock->stock;
            $dataToken = JWT::encode($dataAccessToken, $this->configKey, 'HS256');
            $response['code'] = "SUCCESS";
            $response['access_token'] = $dataToken;
            echo json_encode($response);
            exit();
        }else{
            http_response_code(419);
            exit();
        }
    }

    public function submitTransaksi(Request $request){
        if ( $this->header != ""){
            try{
                $submitTransaksi = new StockTransaction;
                $submitTransaksi->stock_id = $request->stock_id;
                $submitTransaksi->user_id = $request->user_id;
                $submitTransaksi->stock = $request->stock;
                $submitTransaksi->created_at = date("Y-m-d H:i:s");
                $submitTransaksi->save();

                $updateStock = Stock::find( $request->stock_id);
                $updateStock->stock = $updateStock->stock - $request->stock;
                $updateStock->save();

                $response['code'] = "SUCCESS";
                echo json_encode($response);
                exit();
            }catch (Exception $e){
                $response['code'] = "FAILED";
                $response['message'] = $e->getMessage();
                echo json_encode($response);
                exit();
            }
        }else{
            http_response_code(419);
            exit();
        }
    }

    public function viewTransaksibyUser($user){
        if ( $this->header != ""){
            $user = User::find($user);
            $dataTransaction = array();
            if ( !(isset($user->stocks) )) {
                $response['code'] = "NOT FOUND";
                http_response_code(404);
                echo json_encode($response);
                exit();
            }

            
            foreach( $user->stocks as $key => $value ){
                $transactionName['name'] = $value->barang->name;
                $transactionName['qty'] = $value->stock;
                $transactionName['datetime'] = date("d-M-Y", strtotime($value->created_at));
                $dataTransaction[] = $transactionName;
            }
            $dataAccessToken['username'] = $user->name;
            $dataAccessToken['email'] = $user->email;
            $dataAccessToken['transaction'] = $dataTransaction;
            $dataToken = JWT::encode($dataAccessToken, $this->configKey, 'HS256');
            $response['code'] = "SUCCESS";
            $response['access_token'] = $dataToken;
            echo json_encode($response);
            exit();

        }else{
            http_response_code(419);
            exit();
        }
    }

    public function viewTransaksibyStock($id){
        if ( $this->header != ""){
            $stock = Stock::find($id);
            $dataTransaction = array();
            if ( !(isset($stock->details) )) {
                $response['code'] = "NOT FOUND";
                http_response_code(404);
                echo json_encode($response);
                exit();
            }

            foreach( $stock->details as $key => $value ){
                $transactionName['product_name'] = $value->barang->name;
                $transactionName['user'] = $value->user->name;
                $transactionName['stock'] = $value->stock;
                $transactionName['datetime'] = date("d-M-Y", strtotime($value->created_at));
                $dataTransaction[] = $transactionName;
            }
            $dataAccessToken['name'] = $stock->name;
            $dataAccessToken['transaction'] = $dataTransaction;
            $dataToken = JWT::encode($dataAccessToken, $this->configKey, 'HS256');
            $response['code'] = "SUCCESS";
            $response['access_token'] = $dataToken;
            echo json_encode($response);
            exit();
        }else{
            http_response_code(419);
            exit();
        }
    }

    public function getProductUser(){
        if ( $this->header != ""){
            $allUser = User::get();
            $allProduct = Stock::get();
            $dataAccessToken['listUser'] = array();
            foreach ( $allUser as $key => $value ){
                $listUser['user_id'] = $value->id;
                $listUser['user_name'] = $value->name;
                $listUser['email'] = $value->email;
                $listUser['phone'] = $value->phone;
                $dataAccessToken['listUser'][] = $listUser;
            }

            $dataAccessToken['listStock'] = array();
            foreach ( $allProduct as $key => $value ){
                $listStock['stock_id'] = $value->id;
                $listStock['stock_name'] = $value->name;
                $listStock['sku'] = $value->sku;
                $listStock['stock'] = $value->stock;
                $dataAccessToken['listStock'][] = $listStock;
            }

            $dataToken = JWT::encode($dataAccessToken, $this->configKey, 'HS256');
            $response['code'] = "SUCCESS";
            $response['access_token'] = $dataToken;
            echo json_encode($response);
            exit();
        }else{
            http_response_code(419);
            exit();
        }
    }

    public function history(){
        if ( $this->header != ""){
            $getTransaksi = StockTransaction::paginate(15);
            $dataAccessToken['transaksi'] = array();
            foreach ( $getTransaksi as $key => $value ){
                $transaksi['product_name'] = $value->barang->name;
                $transaksi['user_name'] = $value->user->name;
                $transaksi['qty'] = $value->stock;
                $transaksi['created_at'] = date("Y-m-d H:i:s", strtotime($value->created_at));
                $dataAccessToken['transaksi'][] = $transaksi;
            }

            $dataToken = JWT::encode($dataAccessToken, $this->configKey, 'HS256');
            $response['code'] = "SUCCESS";
            $response['access_token'] = $dataToken;
            echo json_encode($response);
            exit();
        }else{
            http_response_code(419);
            exit();
        }
    }

    public function viewAll(){
        return view("stock::stock_view");
    }

}
