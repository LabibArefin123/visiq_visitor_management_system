<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorProbation;
use Carbon\Carbon;

class VisitorProbationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2025, 11, 10);
        $endDate = Carbon::create(2026, 2, 20);

        $reasons = [
            'Late arrival for multiple scheduled meetings.',
            'Miscommunication with reception staff.',
            'Brought unauthorized items into the office.',
            'Uncooperative behavior during security check.',
            'Violation of visitor time policy.',
            'Incomplete visitor documentation during entry.',
            'Attempted access to restricted area.',
            'Argument with office security personnel.',
            'Repeated schedule cancellations without notice.',
            'Use of mobile devices in restricted zones.',
            'Failure to wear visitor ID badge properly.',
            'Disrespectful communication with front desk staff.',
            'Attempted entry outside visiting hours.',
            'Breach of visitor dress code.',
            'Not following host meeting protocol.',
        ];

        for ($i = 1; $i <= 15; $i++) {
            $probationStart = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));
            $probationEnd = (clone $probationStart)->addDays(rand(5, 15));

            VisitorProbation::create([
                'probation_id' => 'VP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => 'Demo Probation Visitor ' . $i,
                'phone' => '017000000' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'national_id' => '1000' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'reason' => $reasons[$i - 1],
                'status' => collect(['Pending', 'Approved', 'Cancelled'])->random(),
                'probation_start' => $probationStart,
                'probation_end' => $probationEnd,
            ]);
        }
    }
}
