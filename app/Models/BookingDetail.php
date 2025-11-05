<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BookingDetail extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'booking_detail';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['booking_id', 
                            'dish_id',                           
                            'amount', 
                            'price', 
                            'total_price'        
                            ];

    public function booking()
    {
        return $this->belongsTo('App\Models\Booking', 'booking_id');
    } 
    public function dish()
    {
        return $this->belongsTo('App\Models\Dish', 'dish_id');
    }  
}
