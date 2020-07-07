<?php																														
    namespace App\Providers;															
    use Illuminate\Support\ServiceProvider;															
    use Illuminate\Support\Facades\Schema;															
    use App\TypeProduct;															
    use Session;															
    use App\Cart;															
                                                                                                                            
                                                                                                                            
    class AppServiceProvider extends ServiceProvider															
    {															
    /**	* Bootstrap any application services.															
    *															
    * @return void															
    */															
        public function boot()															
        {															
            view()->composer('header',function($view){															
                $loai_sp = TypeProduct::all();															
                                                                            
                $view->with('loai_sp',$loai_sp);															
            });															
                                                                
            view()->composer('header',function($view){															
            if(Session('cart')){															
                    $oldCart = Session::get('cart');															
                    $cart = new Cart($oldCart);															
                    $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalQty'=> $cart->totalQty]);															
                }															
            });															
        }															
                                                                
        /**															
         * Register any application services.															
         *															
            * @return void															
            */															
        public function register()															
    {																														
    }															
}															