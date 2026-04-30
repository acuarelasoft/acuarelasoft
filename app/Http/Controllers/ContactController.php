<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(ContactFormRequest $request): RedirectResponse
    {
        if ($request->filled('website')) {
            return redirect()->back();
        }

        $validated = $request->validated();

        Log::info('Contact form submission', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'project_type' => $validated['project_type'],
        ]);

        Mail::raw($this->buildEmailBody($validated), function ($mail) use ($validated) {
            $mail->to('contacto@acuarelasoft.dev')
                ->replyTo($validated['email'], $validated['name'])
                ->subject('Solicitud de llamada: '.$validated['name'].' — '.$validated['project_type']);
        });

        return redirect()->back()->with('success', __('landing.contact_success'));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function buildEmailBody(array $data): string
    {
        $body = "Nombre: {$data['name']}\n";
        $body .= "Email: {$data['email']}\n";
        $body .= "Tipo de proyecto: {$data['project_type']}\n";

        if (! empty($data['company'])) {
            $body .= "Empresa: {$data['company']}\n";
        }
        if (! empty($data['phone'])) {
            $body .= "Teléfono: {$data['phone']}\n";
        }
        if (! empty($data['availability'])) {
            $body .= "Disponibilidad: {$data['availability']}\n";
        }

        $body .= "\nMensaje:\n{$data['message']}";

        return $body;
    }
}
