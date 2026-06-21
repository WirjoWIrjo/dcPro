{{-- Inherits the global layout defined in layouts/app.blade.php --}}
@extends('layouts.app')

{{-- Dynamic title specific to the professional profile --}}
@section('title', 'About the Lead Engineer')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        {{-- Profile Image: Showcases the professional behind the Data Center project --}}
        <div class="col-lg-4 text-center mb-4 mb-lg-0">
            <div class="p-3 bg-white shadow-sm rounded-circle d-inline-block">
                {{-- Use a professional photo placeholder or your actual photo --}}
                <img src="https://ui-avatars.com/api/?name=Wirjo+DCES&background=0d6efd&color=fff&size=300"
                    class="img-fluid rounded-circle" 
                    alt="Wirjo - Engineering Support">
            </div>
        </div>

        {{-- Professional & Academic Biography --}}
        <div class="col-lg-8">
            <h6 class="text-primary fw-bold text-uppercase">Professional Profile</h6>
            <h1 class="fw-bold mb-3">Wirjo Wirjo</h1>
            <p class="lead text-muted">Data Centre Engineering Support Office Boy & Information Systems Student.</p>
            
            <hr class="my-4">

            <div class="row">
                {{-- Career Summary: Highlights current role at STT GDC Indonesia --}}
                <div class="col-md-6 mb-4">
                    <h5 class="fw-bold"><i class="bi bi-briefcase me-2 text-primary"></i>Career Path</h5>
                    <p>Currently serving as the Engineering Support at DataCenterPro. Responsible for managing critical infrastructure, ensuring 24/7 reliability, and coordinating with partners like ABB, Schneider Electric, Siemens, Eaton, etc.</p>
                </div>

                {{-- Academic Background: Connects professional work with Information Systems study --}}
                <div class="col-md-6 mb-4">
                    <h5 class="fw-bold"><i class="bi bi-mortarboard me-2 text-primary"></i>Education</h5>
                    <p>Pursuing a degree in Information Systems at UNPAM. Focusing on bridging industrial automation with digital data management systems.</p>
                </div>
            </div>

            {{-- Skill Tags: Represents the intersection of Automation, Data, and Energy Management --}}
            <div class="mt-2">
                <span class="badge bg-primary p-2 px-3 me-2 mb-2">Industrial Automation</span>
                <span class="badge bg-primary p-2 px-3 me-2 mb-2">SCADA & EMS</span>
                <span class="badge bg-primary p-2 px-3 me-2 mb-2">Python Scripting</span>
                <span class="badge bg-primary p-2 px-3 me-2 mb-2">ISO 50001 EMS Compliance</span>
                <span class="badge bg-primary p-2 px-3 me-2 mb-2">Problem Management System</span>
            </div>
        </div>
    </div>

    {{-- Project Vision Section: Explains the 'Why' behind the tugasWirjo project --}}
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="p-5 bg-dark text-white rounded-4 shadow">
                <h3 class="fw-bold mb-3">Project Vision: "tugasWirjo"</h3>
                <p class="mb-0">Aplikasi ini dirancang bukan hanya sebagai tugas kuliah, tetapi sebagai prototipe sistem monitoring terpadu yang menggabungkan transparansi data operasional dengan metrik efisiensi energi (PUE). Melalui integrasi **Laravel** dan **Industrial Protocols**, kami bertujuan untuk menciptakan standar baru dalam visualisasi performa Data Center yang andal dan berkelanjutan.</p>
            </div>
        </div>
    </div>
</div>
@endsection