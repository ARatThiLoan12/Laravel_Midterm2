<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\TypeProduct;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
use DB;

class PageController extends Controller
{
    //
    public function getIndex(){
        $slide = Slide::all();
        $new_product = Product::where('new',1)->paginate(8);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);
       return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }
    public function getAbout(){
        return view('page.about');
    }
    public function getContact(){
        return view('page.contacts');
    }
    public function getChitiet(Request $req,$id){
        $sanpham = Product::where('id', $id)->first();
        //get san pham tuong tu
        $sp_tuongtu = Product::where('id_type', $sanpham->id_type)->paginate(3);
        //get sp ban chay
        $sp_banchay = Product::where('promotion_price', '=', 0)->paginate(3);
        //get sp new
        $sp_new = Product::select('id', 'name', 'id_type', 'description', 'unit_price', 'promotion_price', 'image', 'unit', 'new', 'created_at', 'updated_at')->where('new','>',0)->orderBy('updated_at','ASC')->paginate(3);
        return view('page.product', compact('sanpham', 'sp_tuongtu', 'sp_banchay', 'sp_new'));
    }
    public function getLoaiSanPham($type){
        //get product same type
        $sp_theoloai= Product::where('id_type',$type) ->limit(3)->get();
        //get product different type
        $sp_khac= Product::where('id_type','<>',$type)->limit(3)->get();
        //get product type
        $loai = TypeProduct::all();
        //get product to left menu
        $loai_sp = TypeProduct::where('id', $type)->first();
        return view('page.product_type',compact('sp_theoloai','sp_khac','loai','loai_sp'));

    }
    //them vao gio hang
    public function getAddToCart(Request $req, $id){					
        $product = Product::find($id);					
        $oldCart = Session('cart')?Session::get('cart'):null;					
        $cart = new Cart($oldCart);					
        $cart->add($product,$id);					
        $req->session()->put('cart', $cart);					
        return redirect()->back();					  
    }
    //xoa khoi gio hang
    public function getDelItemCart($id){               
        $oldCart = Session::has('cart')?Session::get('cart'):null;              
        $cart = new Cart($oldCart);             
        $cart->removeItem($id);             
        if(count($cart->items)>0){              
        Session::put('cart',$cart);             
        }               
        else{               
            Session::forget('cart');                
        }               
        return redirect()->back();              
    }
    //dat hang
    public function getCheckout(){
        $oldCart = Session::get('cart');

        
        $cart = new Cart($oldCart);
        return view('page.checkout')->with(['cart','product_cart'=>$cart->items,
        'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
    }

    public function postCheckout(Request $req){                        
        $cart = Session::get('cart');                      
                            
        $customer = new Customer;
        $customer->name = $req->names;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();
                    
                      
        $bill = new Bill;                      
        $bill->id_customer = $customer->id;                    
        $bill->date_order = date('Y-m-d');                      
        $bill->total = $cart->totalPrice;                      
        $bill->payment = $req->payment_method;                      
        $bill->note = $req->notes;                      
        $bill->save();                      
                        
        foreach($cart->items as $item){
            $billdetail = new BillDetail();
            $billdetail->id_bill= $bill->id;
            $billdetail->id_product=$item['item']['id'];
            //lay gia tung san pham theo cach la chia so luong
            $billdetail->unit_price=$item['price']/$item['qty'];
            $billdetail->quantity=$item['qty'];
            $billdetail->save();
        }                  
        Session::forget('cart');
        return redirect()->back();                      	
    }
    //dang ki
    public function getSignin(){
        return view('page.signup');
    }

    public function postSignin(Request $req){
        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = $req->password;
        //$user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        if($req->password == $req->re_password){
            $user->save();
            return redirect()->back()->with('thanhcong','successful');
        }
        else{
           return redirect()->back()->with('thatbai','fail, dang nhap lai');
        }
        
    }
    //admin
    public function getList(){
        $product = Product::all();
        return view('page.admin.admin', compact('product'));
    }
    public function viewInsertProduct(){
        $type= DB::table('type_products')->select('id','name')->get();
        return view('page.admin.insert',compact('type'));
    }
    public function insertProduct(Request $rq){
        $product = new Product;
        $product->name = $rq->name;
        $product->id_type = $rq->type;
        $product->description = $rq->description;
        $product->unit_price = $rq->unit_price;
        $product->promotion_price = $rq->promotion_price;


        $file_name = $rq->file('myFile')->getClientOriginalName();
        $product->image = $file_name;
        $rq->file('myFile')->move('source/image/product/',$file_name);

        $product->unit = $rq->unit;
        $product->new = $rq->new;
        $product->save();
        return redirect()->action("PageController@getList");    
    }
      public function deleteProduct($id) 
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->action("PageController@getList");
    }

    public function viewEdit ($id) 
    {
        $product = Product::find($id);
        return view('page.admin.edit',compact('product'));
    }

    public function editProduct(Request $rq, $id) 
    {
        $product = Product::find($id);

        $product->name = $rq->name;
        $product->id_type = $rq->type;
        $product->description = $rq->description;
        $product->unit_price = $rq->unit_price;
        $product->promotion_price = $rq->promotion_price;


        $file_name = $rq->file('myFile')->getClientOriginalName();
        $product->image = $file_name;
        $rq->file('myFile')->move('source/image/product/',$file_name);

        $product->unit = $rq->unit;
        $product->new = $rq->new;
        $product->save();
        return redirect()->action("PageController@getList");
    }


    //email order
    public function postOrder(Request $req){
        $cart = Session::get('cart');
        $cus = new Customer();
        $cus->name= $req->name;
        $cus->gender=$req->gender;
        $cus->email=$req->email;
        $cus->address=$req->address;
        $cus->note=$req->notes;
        $cus->phone_number=$req->phone;
        $cus->save();
        $bill = new Bill();
        $bill->id_customer= $cus->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment_method;
        $bill->note=$req->notes;
        $bill->save();
        foreach($cart->items as $item){
            $billdetail = new BillDetail();
            $billdetail->id_bill= $bill->id;
            $billdetail->id_product=$item['item']['id'];
            //lay gia tung san pham theo cach la chia so luong
            $billdetail->unit_price=$item['price']/$item['qty'];
            $billdetail->quantity=$item['qty'];
            $billdetail->save();
        }
        Mail::to($cus->email)->send(new mailOrder($cart->items,$cus->name,$cart->totalPrice));
        Session::forget('cart');
        return redirect()->back();
    }
}
