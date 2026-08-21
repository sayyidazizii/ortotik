<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DataPackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Exception;

class DataPackageController extends Controller
{
    protected DataPackageService $packageService;

    public function __construct(DataPackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    /**
     * Generate package and initiate direct browser download
     */
    public function export(): BinaryFileResponse|\Illuminate\Http\RedirectResponse
    {
        try {
            $zipPath = $this->packageService->createPackage();
            $filename = basename($zipPath);

            return response()->download($zipPath, $filename, [
                'Content-Type' => 'application/zip',
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat paket ekspor: ' . $e->getMessage());
        }
    }

    /**
     * Handle uploaded package zip from Admin UI
     */
    public function import(Request $request)
    {
        $request->validate([
            'package_file' => 'required|file|mimes:zip|max:512000', // max 500MB
        ], [
            'package_file.required' => 'Silakan pilih file paket .ZIP yang ingin diunggah.',
            'package_file.mimes' => 'Format file harus berupa arsip .ZIP.',
            'package_file.max' => 'Ukuran file paket melebihi batas maksimal 500MB.',
        ]);

        try {
            $file = $request->file('package_file');
            $tempPath = $file->getRealPath();

            $stats = $this->packageService->importPackage($tempPath);

            // Also save a copy to packages directory for record
            $filename = 'uploaded_' . date('Y_m_d_His') . '_' . $file->getClientOriginalName();
            $targetDir = storage_path('app/packages');
            if (!File::exists($targetDir)) {
                File::makeDirectory($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);

            return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
                ->with('success', "Paket data & aset berhasil di-import dan disinkronkan! (Database terestore, {$stats['storage_files_imported']} file storage, {$stats['image_files_imported']} file gambar).");
        } catch (Exception $e) {
            return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
                ->with('error', 'Gagal mengimport paket: ' . $e->getMessage());
        }
    }

    /**
     * Restore from an existing package in storage/app/packages
     */
    public function restore(Request $request, string $filename)
    {
        $safeFilename = basename($filename);
        $packagePath = storage_path('app/packages/' . $safeFilename);

        if (!File::exists($packagePath)) {
            return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
                ->with('error', 'File paket tidak ditemukan di server.');
        }

        try {
            $stats = $this->packageService->importPackage($packagePath);

            return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
                ->with('success', "Restore paket '{$safeFilename}' berhasil! Database dan aset telah disinkronkan.");
        } catch (Exception $e) {
            return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
                ->with('error', 'Gagal merestore paket: ' . $e->getMessage());
        }
    }

    /**
     * Download an existing package
     */
    public function download(string $filename): BinaryFileResponse|\Illuminate\Http\RedirectResponse
    {
        $safeFilename = basename($filename);
        $packagePath = storage_path('app/packages/' . $safeFilename);

        if (!File::exists($packagePath)) {
            return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
                ->with('error', 'File paket tidak ditemukan di server.');
        }

        return response()->download($packagePath, $safeFilename);
    }

    /**
     * Delete an existing package
     */
    public function destroy(string $filename)
    {
        $safeFilename = basename($filename);
        $deleted = $this->packageService->deletePackage($safeFilename);

        if ($deleted) {
            return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
                ->with('success', "File paket '{$safeFilename}' berhasil dihapus.");
        }

        return redirect()->route('admin.settings.index', ['tab' => 'data_sync'])
            ->with('error', 'Gagal menghapus file paket.');
    }
}
