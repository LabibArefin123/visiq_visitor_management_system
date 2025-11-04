<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupplyList;

class SupplyListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplies = [
            ['item_name' => 'Visitor Badges', 'item_code' => 'SUP-001', 'category' => 'Visitor Management', 'unit' => 'pcs', 'quantity' => 200, 'reorder_level' => 50, 'location' => 'Reception Desk', 'remarks' => 'For visitor identification'],
            ['item_name' => 'Visitor Log Books', 'item_code' => 'SUP-002', 'category' => 'Visitor Management', 'unit' => 'pcs', 'quantity' => 50, 'reorder_level' => 10, 'location' => 'Reception', 'remarks' => 'Manual log of visitors'],
            ['item_name' => 'Visitor Pens', 'item_code' => 'SUP-003', 'category' => 'Stationery', 'unit' => 'pcs', 'quantity' => 100, 'reorder_level' => 20, 'location' => 'Reception', 'remarks' => 'For signing logbooks'],
            ['item_name' => 'Reception Chairs', 'item_code' => 'SUP-004', 'category' => 'Furniture', 'unit' => 'pcs', 'quantity' => 20, 'reorder_level' => 5, 'location' => 'Waiting Room', 'remarks' => 'Visitor seating'],
            ['item_name' => 'Visitor Tables', 'item_code' => 'SUP-005', 'category' => 'Furniture', 'unit' => 'pcs', 'quantity' => 5, 'reorder_level' => 1, 'location' => 'Waiting Room', 'remarks' => 'For visitor documents'],
            ['item_name' => 'Hand Sanitizers', 'item_code' => 'SUP-006', 'category' => 'Hygiene', 'unit' => 'bottles', 'quantity' => 30, 'reorder_level' => 10, 'location' => 'Reception', 'remarks' => 'For visitor and staff hygiene'],
            ['item_name' => 'Face Masks', 'item_code' => 'SUP-007', 'category' => 'Hygiene', 'unit' => 'pcs', 'quantity' => 200, 'reorder_level' => 50, 'location' => 'Reception', 'remarks' => 'Visitor masks for safety'],
            ['item_name' => 'Visitor Chairs (Waiting Area)', 'item_code' => 'SUP-008', 'category' => 'Furniture', 'unit' => 'pcs', 'quantity' => 30, 'reorder_level' => 5, 'location' => 'Waiting Room', 'remarks' => 'Extra seating for visitors'],
            ['item_name' => 'Visitor Sign Boards', 'item_code' => 'SUP-009', 'category' => 'Signage', 'unit' => 'pcs', 'quantity' => 10, 'reorder_level' => 2, 'location' => 'Reception', 'remarks' => 'Directional signs'],
            ['item_name' => 'Visitor ID Holders', 'item_code' => 'SUP-010', 'category' => 'Visitor Management', 'unit' => 'pcs', 'quantity' => 150, 'reorder_level' => 30, 'location' => 'Reception', 'remarks' => 'Badge holders'],
            ['item_name' => 'Notice Boards', 'item_code' => 'SUP-011', 'category' => 'Furniture', 'unit' => 'pcs', 'quantity' => 5, 'reorder_level' => 1, 'location' => 'Waiting Room', 'remarks' => 'Visitor information display'],
            ['item_name' => 'Visitor Folders', 'item_code' => 'SUP-012', 'category' => 'Stationery', 'unit' => 'pcs', 'quantity' => 100, 'reorder_level' => 20, 'location' => 'Reception', 'remarks' => 'For handing documents to visitors'],
            ['item_name' => 'White Board Markers', 'item_code' => 'SUP-013', 'category' => 'Stationery', 'unit' => 'pcs', 'quantity' => 50, 'reorder_level' => 10, 'location' => 'Meeting Rooms', 'remarks' => 'For meetings and discussions'],
            ['item_name' => 'Notice Board Pins', 'item_code' => 'SUP-014', 'category' => 'Stationery', 'unit' => 'box', 'quantity' => 10, 'reorder_level' => 2, 'location' => 'Waiting Area', 'remarks' => 'For pinning notices'],
            ['item_name' => 'Hand Gloves', 'item_code' => 'SUP-015', 'category' => 'Hygiene', 'unit' => 'pairs', 'quantity' => 50, 'reorder_level' => 10, 'location' => 'Reception', 'remarks' => 'For security staff when handling items'],
            ['item_name' => 'Visitor Pens (Ballpoint)', 'item_code' => 'SUP-016', 'category' => 'Stationery', 'unit' => 'pcs', 'quantity' => 150, 'reorder_level' => 30, 'location' => 'Reception', 'remarks' => 'Extra pens for visitors'],
            ['item_name' => 'Visitor Name Tags', 'item_code' => 'SUP-017', 'category' => 'Visitor Management', 'unit' => 'pcs', 'quantity' => 150, 'reorder_level' => 30, 'location' => 'Reception', 'remarks' => 'Reusable name tags'],
            ['item_name' => 'Visitor Registration Forms', 'item_code' => 'SUP-018', 'category' => 'Visitor Management', 'unit' => 'pcs', 'quantity' => 200, 'reorder_level' => 50, 'location' => 'Reception', 'remarks' => 'For manual logging'],
            ['item_name' => 'Visitor Waiting Area Fans', 'item_code' => 'SUP-019', 'category' => 'Electrical', 'unit' => 'pcs', 'quantity' => 5, 'reorder_level' => 1, 'location' => 'Waiting Room', 'remarks' => 'Cooling for visitors'],
            ['item_name' => 'Visitor Coffee Table', 'item_code' => 'SUP-020', 'category' => 'Furniture', 'unit' => 'pcs', 'quantity' => 5, 'reorder_level' => 1, 'location' => 'Waiting Room', 'remarks' => 'For visitor comfort'],
            ['item_name' => 'Visitor Clipboards', 'item_code' => 'SUP-021', 'category' => 'Stationery', 'unit' => 'pcs', 'quantity' => 50, 'reorder_level' => 10, 'location' => 'Reception', 'remarks' => 'For filling forms'],
            ['item_name' => 'Visitor Arrival Stamp', 'item_code' => 'SUP-022', 'category' => 'Stationery', 'unit' => 'pcs', 'quantity' => 5, 'reorder_level' => 1, 'location' => 'Reception', 'remarks' => 'Stamp for visitor check-in'],
            ['item_name' => 'Visitor Direction Board', 'item_code' => 'SUP-023', 'category' => 'Signage', 'unit' => 'pcs', 'quantity' => 10, 'reorder_level' => 2, 'location' => 'Reception', 'remarks' => 'Guide for visitors'],
            ['item_name' => 'Visitor Waiting Room Magazines', 'item_code' => 'SUP-024', 'category' => 'Furniture', 'unit' => 'pcs', 'quantity' => 20, 'reorder_level' => 5, 'location' => 'Waiting Room', 'remarks' => 'Reading material for visitors'],
            ['item_name' => 'Visitor Hand Sanitizer Stands', 'item_code' => 'SUP-025', 'category' => 'Hygiene', 'unit' => 'pcs', 'quantity' => 10, 'reorder_level' => 2, 'location' => 'Reception', 'remarks' => 'Automatic sanitizer stands for visitors'],
        ];

        foreach ($supplies as $supply) {
            SupplyList::create($supply);
        }
    }
}
