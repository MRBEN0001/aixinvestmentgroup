<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Mail\AdminToUserMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Textarea;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\Rules\Password;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('changePassword')
                ->form([
                    TextInput::make('new_password')
                        ->password()
                        ->label('New Password')
                        ->required()
                        ->rule(Password::default()),

                    TextInput::make('new_password_confirmation')
                        ->password()
                        ->label('Confirm New Password')
                        ->required()
                        ->same('new_password')
                        ->rule(Password::default()),
                ])->action(function (array $data) {
                    $this->record->update([
                        'password' => Hash::make($data['new_password'])
                    ]);

                    $this->notify('success', 'Password updated succesfully');
                    return redirect('/admin/users');
                }),
            Actions\Action::make('Send A Message')
                ->form([
                    TextInput::make('subject')
                        ->label('Email Subject')
                        ->required(),

                    Textarea::make('body')
                        ->label('Email Body')
                        ->required()
                ])->action(function (array $data) {
                    try {
                        Mail::to($this->record->email)->send(new AdminToUserMail([
                            'name' => $this->record->name,
                            'subject' => $data['subject'],
                            'body' => $data['body']
                        ]));
                    } catch (\Throwable $error) {
                        Log::error('SMTP network error:' . $error->getMessage());
                        $this->notify('danger', 'Message could not be sent. Try again!');
                        return back();
                    }


                    $this->notify('success', 'Email Sent');
                    return redirect('/admin/users');
                }),

            Actions\Action::make($this->record->account_disabled ? 'Enable User' : 'Disable User')
                ->action(function (array $data) {
                    $this->record->update([
                        'account_disabled' => !$this->record->account_disabled,
                    ]);
                    $this->notify('success', 'Success');
                }),
            Actions\Action::make($this->record->is_investing_suspended ? 'Enable Investing' : 'Disable Investing')
                ->action(function (array $data) {
                    $this->record->update([
                        'is_investing_suspended' => !$this->record->is_investing_suspended,
                    ]);
                    $this->notify('success', 'Success');
                })
        ];
    }
}
