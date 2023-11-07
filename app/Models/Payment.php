<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment
 *
 * @property string $id
 * @property mixed $payer_name
 * @property mixed $payer_email
 * @property mixed $payer_address
 * @property float $amount
 * @property string $currency
 * @property string $provider
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @method static \Database\Factories\PaymentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'payer_name',
        'payer_email',
        'payer_address',
        'amount',
        'currency',
        'provider',
    ];

    protected $casts = [
        'payer_name' => 'encrypted',
        'payer_email' => 'encrypted',
        'payer_address' => 'encrypted',
    ];

    public function amount(): Attribute
    {
        return Attribute::make(
            get: function (int $value): float {
                return $value / 100;
            },
            set: function (float $value): int {
                return (int) ($value * 100);
            }
        );
    }
}
