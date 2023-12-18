<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Assignment\Assignment;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class ValidateLetterController extends Controller
{
    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function assignment(string $assignment, string $userId)
    {
        try {
            $assignmentId = decrypt($assignment);
            $userId = decrypt($userId);

            $assignment = Assignment::whereId($assignmentId)->first();

            if (!$assignment) {
                throw new \Exception('Assignment not found');
            }

            if ($assignment->status != $this->constants->assignment_status[1]) {
                throw new \Exception('Assignment not valid');
            }

            $userAssignment = $assignment->userAssignments()->whereId($userId)->first();

            if (!$userAssignment) {
                throw new \Exception('User assignment not found');
            }

            if ($userAssignment->user_id) {
                $user = [
                    'name' => $userAssignment->user->name,
                    'nik' => $userAssignment->user->userEmployment->employee_id,
                    'position' => $userAssignment->user->division->divisi_name,
                ];
            } else {
                $user = [
                    'name' => $userAssignment->name,
                    'nik' => $userAssignment->nik,
                    'position' => $userAssignment->position,
                ];
            }

            if ($assignment->signed_by) {
                $signed = [
                    'name' => $assignment->signedBy->name,
                    'nik' => $assignment->signedBy->userEmployment->employee_id,
                    'position' => $assignment->signedBy->division->divisi_name,
                ];
            } else {
                $signed = [
                    'name' => $assignment->user->name,
                    'nik' => $assignment->user->userEmployment->employee_id,
                    'position' => $assignment->user->division->divisi_name,
                ];
            }

            return view('letter-validation.assignment.valid', compact([
                'assignment', 'user', 'signed'
            ]));
        } catch (\Exception $e) {
            return view('letter-validation.assignment.not-valid');
        }
    }
}
