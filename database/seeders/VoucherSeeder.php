<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        $vouchers = [
            [
                'code' => 'HEMAT10',
                'discount_percentage' => 10,
                'discount_amount' => null,
                'min_order_amount' => 50000,
                'max_discount_amount' => 10000,
                'expiry_date' => Carbon::now()->addMonths(3),
                'max_uses' => 100,
                'used_count' => 0,
                'is_active' => true,
            ],

            [
                'code' => 'POTONG20K',
                'discount_percentage' => null,
                'discount_amount' => 20000,
                'min_order_amount' => 100000,
                'max_discount_amount' => null,
                'expiry_date' => Carbon::now()->addMonth(),
                'max_uses' => 50,
                'used_count' => 0,
                'is_active' => true,
            ],

            [
                'code' => 'WELCOME15',
                'discount_percentage' => 15,
                'discount_amount' => null,
                'min_order_amount' => 0,
                'max_discount_amount' => 15000,
                'expiry_date' => Carbon::now()->addMonths(6),
                'max_uses' => null,
                'used_count' => 0,
                'is_active' => true,
            ],

            [
                'code' => 'FLASH50',
                'discount_percentage' => 50,
                'discount_amount' => null,
                'min_order_amount' => 200000,
                'max_discount_amount' => 50000,
                'expiry_date' => Carbon::now()->addDays(10),
                'max_uses' => 20,
                'used_count' => 0,
                'is_active' => true,
            ],

            [
                'code' => 'EXPIREDTEST',
                'discount_percentage' => 30,
                'discount_amount' => null,
                'min_order_amount' => 50000,
                'max_discount_amount' => 30000,
                'expiry_date' => Carbon::now()->subDays(2),
                'max_uses' => 10,
                'used_count' => 3,
                'is_active' => false,
            ],

        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}
