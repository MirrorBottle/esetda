<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Inbox;
use App\Outbox;
use App\Archive;
use App\Clasification;
use Carbon\Carbon;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
        $date = Carbon::parse('2020-02-01');
        $inboxes = Inbox::limit(30)->get();
        $outboxes = Outbox::limit(30)->get();

        foreach ($inboxes as $index => $inbox) {
            $biro_id = $inbox->user->biro_id;
            if ($biro_id == 1 || $biro_id == 6) {
                $inbox->update(['is_archived' => 1]);
                $operator = $this->getOperatorByBiro($biro_id);
                $data[] = [
                    'biro_id' => $biro_id,
                    'user_id' => $operator->id,
                    'archivable_type' => 'App\Inbox',
                    'archivable_id' => $inbox->id,
                    'clasification_id' => $this->randomClasification(),
                    'year' => rand(2016, 2020),
                    'date' => $date->copy()->addDays($index)->format('Y-m-d'),
                    'qty' => rand(1, 3),
                    'condition' => rand(0, 1),
                ];
            }
        }

        foreach ($outboxes as $index => $outbox) {
            $biro_id = $outbox->user->biro_id;
            $outbox->update(['is_archived' => 1]);
            $operator = $this->getOperatorByBiro($biro_id);
            $data[] = [
                'biro_id' => $biro_id,
                'user_id' => $operator->id,
                'archivable_type' => 'App\Outbox',
                'archivable_id' => $outbox->id,
                'clasification_id' => $this->randomClasification(),
                'year' => rand(2016, 2020),
                'date' => $date->copy()->addDays($index)->format('Y-m-d'),
                'qty' => rand(1, 3),
                'condition' => rand(0, 1),
            ];
        }

        Archive::insert($data);
    }

    private function getOperatorByBiro($biro_id)
    {
        return User::where('biro_id', $biro_id)
            ->where('type', 3)
            ->first();
    }

    private function randomClasification()
    {
        $clasification_id = Clasification::pluck('id');

        return rand(1, count($clasification_id));
    }
}
