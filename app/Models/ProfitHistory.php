<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitHistory extends Model
{
    use HasFactory;

    // Specify the table name if it is different from the default
    protected $table = 'profit_histories';

    // Define the fillable properties (adjust according to your database schema)
    protected $fillable = [
        'user_id', 'user_plan_id', 'amount', 'description', 'payout_amount','payout_status', 'transaction_id', 'created_at', 'updated_at'
    ];

    // Define any relationships (if necessary)
    public function userPlan()
    {
        return $this->belongsTo(UserPlan::class);
    }
}
