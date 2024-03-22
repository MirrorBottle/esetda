<?php

use Illuminate\Database\Seeder;
use App\Biro;
use App\User;
use App\Forward;
use App\Inbox;
use App\Outbox;

class ForwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inboxes = Inbox::limit(20)->get();
        $outboxes = Outbox::limit(20)->get();

        $data = array();
        foreach ($inboxes as $inbox) {
            $biro = $this->randomBiro($inbox->biro_id);
            $operator = $this->getOperatorByBiro($inbox->biro_id);
            $data[] = [
                'biro_id' => $biro->id,
                'user_id' => $operator->id,
                'inbox_id' => $inbox->id,
                'outbox_id' => null,
                'note' => '-',
                'is_received' => false,
            ];
        }

        foreach ($outboxes as $outbox) {
            $biro = $this->randomBiro($outbox->biro_id);
            $operator = $this->getOperatorByBiro($outbox->biro_id);
            $data[] = [
                'biro_id' => $biro->id,
                'user_id' => $operator->id,
                'inbox_id' => null,
                'outbox_id' => $outbox->id,
                'note' => '-',
                'is_received' => false,
            ];
        }

        Forward::insert($data);
    }

    private function getOperatorByBiro($biro_id)
    {
        return User::where('biro_id', $biro_id)
            ->where('name', 'like', '%operator%')
            ->first();
    }

    private function randomBiro($biro_id)
    {
        return Biro::where('id', '!=', $biro_id)
            ->inRandomOrder()
            ->first();
    }
}
