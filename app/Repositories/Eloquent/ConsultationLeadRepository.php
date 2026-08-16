<?php

namespace App\Repositories\Eloquent;

use App\Models\ConsultationLead;
use App\Repositories\Contracts\ConsultationLeadRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ConsultationLeadRepository extends BaseRepository implements ConsultationLeadRepositoryInterface
{
    public function __construct(ConsultationLead $model)
    {
        parent::__construct($model);
    }

    public function getAll(int $perPage = 15, ?string $status = null, ?string $search = null): LengthAwarePaginator
    {
        $query = $this->model->newQuery()
            ->with(['branch', 'medicalService'])
            ->latest();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('complaint_type', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function findById(int $id): ?ConsultationLead
    {
        return $this->model->find($id);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $lead = $this->findById($id);
        if (!$lead) {
            return false;
        }
        return $lead->update(['status' => $status]);
    }

    public function countByStatus(): array
    {
        return [
            'total' => $this->model->count(),
            'new' => $this->model->where('status', 'new')->count(),
            'contacted' => $this->model->where('status', 'contacted')->count(),
            'scheduled' => $this->model->where('status', 'scheduled')->count(),
            'completed' => $this->model->where('status', 'completed')->count(),
        ];
    }
}
