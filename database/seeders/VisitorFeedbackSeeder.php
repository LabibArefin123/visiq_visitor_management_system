<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorFeedbacks;
use App\Models\Visitor;
use App\Models\PendingVisitor;
use Carbon\Carbon;

class VisitorFeedbackSeeder extends Seeder
{
    public function run(): void
    {
        $positiveFeedbacks = [
            'Very friendly staff and smooth entry process!',
            'Great hospitality — the security team was very professional.',
            'Quick verification process, impressed with the organization.',
            'Loved the cleanliness and environment of the office.',
            'The visitor management system is really efficient.',
            'The reception area was well-managed and welcoming.',
            'Appreciated the polite and respectful behavior of all staff.',
            'Everything was well organized, no waiting time at all.',
            'Had a pleasant experience visiting the office.',
            'Security and support staff were very helpful and professional.',
            'Great coordination during the visit, thank you!',
            'Excellent communication and quick access provided.',
        ];

        $negativeFeedbacks = [
            'The waiting time was a bit long, could be improved.',
            'Had some confusion during check-in, staff should guide better.',
            'Visitor parking area needs better signage.',
        ];

        $visitors = Visitor::inRandomOrder()->take(10)->get();
        $pendingVisitors = PendingVisitor::inRandomOrder()->take(5)->get();

        $feedbackEntries = [];

        foreach ($visitors as $visitor) {
            $feedbackEntries[] = [
                'visitor_id' => $visitor->id,
                'pending_visitor_id' => null,
                'feedback_text' => fake()->randomElement($positiveFeedbacks),
                'rating' => rand(4, 5),
                'submitted_at' => Carbon::parse(fake()->dateTimeBetween('2025-11-01', '2026-02-01')),
            ];
        }

        foreach ($pendingVisitors as $pendingVisitor) {
            $feedbackEntries[] = [
                'visitor_id' => null,
                'pending_visitor_id' => $pendingVisitor->id,
                'feedback_text' => fake()->randomElement($negativeFeedbacks),
                'rating' => rand(2, 3),
                'submitted_at' => Carbon::parse(fake()->dateTimeBetween('2025-11-01', '2026-02-01')),
            ];
        }

        VisitorFeedbacks::insert($feedbackEntries);
    }
}
