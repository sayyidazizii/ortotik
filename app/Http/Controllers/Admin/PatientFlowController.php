<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PatientFlowController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::all()->keyBy('key');
        return view('admin.patient_flow.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'patient_flow_badge'       => 'nullable|string|max:255',
            'patient_flow_title'       => 'nullable|string|max:255',
            'patient_flow_subtitle'    => 'nullable|string|max:1000',
            'patient_flow_steps_json'  => 'nullable|string',
        ]);

        if ($request->filled('patient_flow_badge')) {
            SiteSetting::set('patient_flow_badge', $request->input('patient_flow_badge'), 'content');
        }
        if ($request->filled('patient_flow_title')) {
            SiteSetting::set('patient_flow_title', $request->input('patient_flow_title'), 'content');
        }
        if ($request->filled('patient_flow_subtitle')) {
            SiteSetting::set('patient_flow_subtitle', $request->input('patient_flow_subtitle'), 'content');
        }
        if ($request->has('patient_flow_steps_json')) {
            SiteSetting::set('patient_flow_steps', $request->input('patient_flow_steps_json'), 'content');
        }

        return redirect()->route('admin.patient-flow.index')->with('success', 'Tahapan Alur Pasien berhasil diperbarui.');
    }
}