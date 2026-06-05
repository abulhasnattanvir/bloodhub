<?php

namespace App\Console\Commands;

use App\Models\FeeStructure;
use App\Models\Member;
use App\Models\MemberSubscription;
use Illuminate\Console\Command;

class GenerateMonthlySubscriptions extends Command
{
    protected $signature = 'generate:subscriptions';
    protected $description = 'Generate monthly subscriptions';

    public function handle()
    {
        $month = now()->format('Y-m');

        $members = Member::all();

        foreach ($members as $member) {

            $fee = FeeStructure::where('profession', $member->profession)->first();

            MemberSubscription::firstOrCreate([
                'member_id' => $member->id,
                'month' => $month
            ], [
                'expected_amount' => $fee->monthly_fee ?? 0,
                'status' => 'unpaid'
            ]);
        }

        $this->info('Subscriptions generated successfully');
    }
}