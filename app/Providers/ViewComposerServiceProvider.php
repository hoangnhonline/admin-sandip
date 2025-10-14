<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hash;
use App\Models\UserNotification;
use App\Models\Collecter;

use Auth;
use Helper;
class ViewComposerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Call function composerSidebar
		$this->composerMenu();	
		
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Composer the sidebar
	 */
	private function composerMenu()
	{
		
		view()->composer( '*' , function( $view ){		
			
	        // $settingArr = WSettings::whereRaw('1')->pluck('value', 'name');
	        // $articleCate = WArticlesCate::getList(['limit' => 10]);
	        
	        // $tinRandom = WArticles::whereRaw(1);
	        // if($tinRandom->count() > 0){
	        // 	$tinRandom = $tinRandom->limit(5)->get();
	        // }	            	
	       	// //$menuList = Menu::where('menu_id', 1)->orderBy('display_order', 'asc')->get();	       	

	       	// $textArr = WText::whereRaw('1')->pluck('value', 'name');	       	
	        $routeName = \Request::route()->getName();	      
	  
	        //$isEdit = Auth::check();	  
	        $userRole = $notiList = null;
	        $collecterList = Collecter::where('status', 1)->orderBy('display_order')->get();
	        $notNH = true;
	        if(Auth::check()){
	        	$notiList = UserNotification::where('user_id', Auth::user()->id)->where('is_read', 0)->orderBy('id', 'desc')->get();
	        	$userRole = Auth::user()->role;
	        	if(Auth::user()->chup_anh == 1){
		            $collecterList = Collecter::where('branch_id', 7)->get();
		        }
		        $notNH = Auth::user()->id == 515 ? false : true;
	        }
	       	$collecterNameArr = Helper::getCollecterNameArr();
	       	
	       	
			$view->with( [
					// 'settingArr' => $settingArr, 
					// 'articleCate' => $articleCate, 
					'notiList' => $notiList,					
					'routeName' => $routeName,
					// 'textArr' => $textArr,
					// 'isEdit' => $isEdit,
					'userRole' => $userRole,
					'collecterNameArr' => $collecterNameArr,
					'collecterList' => $collecterList,
					'notNH' => $notNH
			] );
			
		});
	}
	
}
