<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nama')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable(), // Untuk melakukan sort atau mengurutkan berdasarkan nama

                TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable(),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable(),

                TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->searchable(),

                TextColumn::make('jurusan')
                    ->label('Prodi')
                    ->searchable(),
                
                TextColumn::make('foto')
                    ->label('Foto')
                    ->searchable(),
                    
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),

                TextColumn::make('angkatan')
                    ->label('Angkatan')
                    ->searchable(),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->searchable(),

                TextColumn::make('agama')
                    ->label('Agama')
                    ->searchable(),
                
            ])

            ->filters([
                //                
                SelectFilter::make('jurusan')
                    ->label('Prodi')
                    ->options([
                            'Teknik Informatika' => 'Teknik Informatika',
                            'Sistem Informasi' => 'Sistem Informasi',
                            'Teknik Elektro' => 'Teknik Elektro',
                        ]),

                SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->label('NIM')
                    ->options([
                            'P' => 'Perempuan',
                            'L' => 'Laki-Laki',
                        ]),

                SelectFilter::make('agama')
                    ->label('Agama')
                    ->options([
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Hindu' => 'Hindu',
                        ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                            'aktif' => 'Aktif',
                            'tidak aktif' => 'Tidak Aktif',
                        ]),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
