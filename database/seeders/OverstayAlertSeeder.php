<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OverstayAlert;
use App\Models\Visitor;
use Carbon\Carbon;

class OverstayAlertSeeder extends Seeder
{
    public function run(): void
    {
        $visitors = Visitor::inRandomOrder()->take(rand(2, 5))->get();

        $startDate = Carbon::create(2025, 11, 1);
        $endDate   = Carbon::create(2026, 3, 1);

        $overstayRate = 0.025; // 2.5% chance of overstaying

        foreach ($visitors as $visitor) {
            // Each visitor comes to office 2–5 times on random days
            $visitCount = rand(2, 5);

            for ($i = 0; $i < $visitCount; $i++) {
                $visitDate = $this->getRandomWeekday($startDate, $endDate);
                $expectedCheckout = (clone $visitDate)->addHours(rand(1, 8)); // within same day 8 AM–9 PM
                $actualCheckout = (clone $expectedCheckout);

                // 2–3% visitors overstay
                if (mt_rand(1, 100) <= 3) {
                    $actualCheckout->addHours(rand(1, 5)); // stayed longer
                    $status = 'Pending';
                } else {
                    $status = ['Pending', 'Resolved'][rand(0, 1)];
                }

                OverstayAlert::create([
                    'visitor_id' => $visitor->id,
                    'visitor_name' => $visitor->name,
                    'visit_date' => $visitDate,
                    'expected_checkout_date' => $expectedCheckout,
                    'actual_checkout_date' => $actualCheckout,
                    'status' => $status,
                    'remarks' => $status === 'Pending' ? 'Visitor overstayed beyond allowed time.' : 'Visitor left as expected.',
                ]);
            }
        }
    }

    private function getRandomWeekday(Carbon $start, Carbon $end): Carbon
    {
        do {
            $date = Carbon::createFromTimestamp(rand($start->timestamp, $end->timestamp))
                ->setTime(rand(8, 20), rand(0, 59));
        } while ($date->isFriday() || $date->isSaturday());

        return $date;
    }
}
