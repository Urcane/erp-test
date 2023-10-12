<?php

namespace App\Console\Commands;

use App\Constants;
use App\Models\Employee\UserEmployment;
use App\Models\Leave\LeaveQuota;
use App\Models\Leave\UserLeaveHistory;
use App\Models\Leave\UserLeaveQuota;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MakeLeaveQuota extends Command
{
    protected $constants;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:leave';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->constants = new Constants();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now();
        $leaveSetting = LeaveQuota::first();
        $users = User::has('userEmployment')->get();

        foreach ($users as $user) {
            $joinDate = Carbon::parse($user->userEmployment->join_date);

            if ($user->userLeaveQuotas->isEmpty()) {
                $this->createQuotaIfEligible($user, $joinDate, $leaveSetting, $today);
            } else {
                $latestLeaveQuotaDate = Carbon::parse($user->userLeaveQuotas->sortByDesc('received_at')->first()->received_at);
                $this->renewQuotaIfEligible($user, $latestLeaveQuotaDate, $leaveSetting, $today);
            }
        }

        return 0;
    }

    protected function createQuotaIfEligible($user, $joinDate, $leaveSetting, $today)
    {
        $joinDate = $joinDate->copy()->addMonths($leaveSetting->min_works);

        while ($joinDate->lt($today)) {
            UserLeaveQuota::create([
                'user_id' => $user->id,
                'quotas' => $leaveSetting->quotas,
                'expired_date' => $joinDate->copy()->addMonths($leaveSetting->expired)->toDateString(),
                'received_at' => $joinDate->toDateString(),
            ]);

            UserLeaveHistory::create([
                "type" => $this->constants->leave_quota_history_type[1],
                "user_id" => $user->id,
                "name" => "Penambahan Kuota Cuti",
                "approval_name" => "Sistem",
                "date" => $joinDate->toDateString(),
                "quota_change" => $leaveSetting->quotas,
            ]);

            $joinDate->addMonths(12);
        }
    }

    protected function renewQuotaIfEligible($user, $latestLeaveQuotaDate, $leaveSetting, $today)
    {
        $date = $latestLeaveQuotaDate->copy()->addMonths(12);

        while ($date->lt($today)) {
            UserLeaveQuota::create([
                'user_id' => $user->id,
                'quotas' => $leaveSetting->quotas,
                'expired_date' => $date->copy()->addMonths($leaveSetting->expired)->toDateString(),
                'received_at' => $date->toDateString(),
            ]);

            UserLeaveHistory::create([
                "type" => $this->constants->leave_quota_history_type[1],
                "user_id" => $user->id,
                "name" => "Penambahan Kuota Cuti",
                "approval_name" => "Sistem",
                "date" => $date->toDateString(),
                "quota_change" => $leaveSetting->quotas,
            ]);

            $date->addMonths(12);
        }
    }
}
