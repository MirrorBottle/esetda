<?php

namespace App\Http\Controllers;

use App\SkpdEmployee;
use Illuminate\Http\Request;
use App\Spt;

class SptReportController extends Controller
{
    public function index()
    {
        $skpd_employees = SkpdEmployee::all();

        return view('spt_report.index', compact('skpd_employees'));
    }

    public function store(Request $request)
    {
        $file_date = to_indo_date($request->date_start, 2, '_') . '_sd_' . to_indo_date($request->date_end, 2, '_');
        $spts = Spt::periode($request)->orderBy('departure_date');
        if ($request->type == "tahunan") {
            $file_date = $request->year_start . '_sd_' . $request->year_end;
            $spts = Spt::yearly($request)->orderBy('departure_date');
        }

        $reports = $this->mapReportData($spts, $request);
        return view('spt_report.print', compact('reports', 'file_date'));
    }

    private function mapReportData($spts, $request)
    {
        $data = array();
        $employees_id = $request->skpd_employee_id;
        if ($request->has('skpd_employee_id')) {
            foreach ($spts->get() as $spt) {
                $skpd_employee = json_decode($spt->skpd_employee, 1);
                foreach ($employees_id as $employee_id) {
                    if (in_array($employee_id, $skpd_employee['id'])) {
                        $employee_name = $skpd_employee['name'][array_search($employee_id, $skpd_employee['id'])];
                        if (array_key_exists($employee_id, $data)) {
                            $data[$employee_id][] = $this->formatSptData($spt, $employee_name);
                        } else {
                            $data[$employee_id] = [$this->formatSptData($spt, $employee_name)];
                        }
                    }
                }
            }
        } else {
            foreach ($spts->get() as $spt) {
                $skpd_employee = json_decode($spt->skpd_employee, 1);
                foreach ($skpd_employee['id'] as $key => $employee_id) {
                    $employee_name = $skpd_employee['name'][$key];
                    if (array_key_exists($employee_id, $data)) {
                        $data[$employee_id][] = $this->formatSptData($spt, $employee_name);
                    } else {
                        $data[$employee_id] = [$this->formatSptData($spt, $employee_name)];
                    }
                }
            }
        }

        return $data;
    }

    private function formatSptData($spt, $employee_name)
    {
        $departure_date = to_indo_date($spt->departure_date->format('Y-m-d'), 1);
        $return_date = to_indo_date($spt->return_date->format('Y-m-d'), 1);
        return [
            'name' => $employee_name,
            'number' => $spt->letter_number_zero_pad,
            'date_range' => $departure_date . ' s/d ' . $return_date . ' (' . $spt->duration . ' hari)',
            'destination' => $spt->destination,
            'duration' => $spt->duration,
            'purpose' => $spt->purpose,
        ];
    }
}
