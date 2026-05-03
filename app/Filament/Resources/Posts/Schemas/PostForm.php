<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;    
use Filament\Schemas\Components\Group;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Fields kiri (2/3)
                Section::make('Post Details')
                    ->description('Fill in the details of the post')
                    ->icon('heroicon-o-document-text')
                    ->schema([

                        // 2 kolom untuk field utama
                        Group::make([
                            TextInput::make('title')
                                ->rules('required | min:3 | max:10')
                                ->minLength(5)
                                ->validationMessages([
                                'required' => 'Judul wajib diisi!',
                                'min' => 'Judul minimal 5 karakter!',
                            ]),
                            TextInput::make('slug')
                                ->rules('required')
                                ->minLength(3)
                                ->unique()
                                ->validationMessages([
                                'required' => 'Slug wajib diisi!',
                                'unique' => 'Slug sudah digunakan!',
                           ]),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required()
                                ->preload()
                                ->searchable(),
                            ColorPicker::make('color'),
                        ])->columns(2),

                        // full width
                        MarkdownEditor::make('body')
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(2),

                // Meta kanan (1/3)
                Group::make([
                    // image
                    Section::make('Image Upload')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->required()
                                ->disk('public')
                                ->directory('post'),
                        ]),
                    // META
                    Section::make('Meta Information')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DateTimePicker::make('published_at'),
                        ]),
                ])
                ->columnSpan(1),

            ])
            ->columns(3); 
    }
}










//lamaaa

// class PostForm
// {
//     public static function configure(Schema $schema): Schema
//     {
//         return $schema
//             ->components([
//                 // section 1 - post details
//                 Section::make('Post Details')
//                     ->description('Fill in the details of the post')
//                     // icon (Heroicon::RocketLaunch)
//                     ->icon('heroicon-o-document-text')
//                     ->schema([
//                         //Grouping fields into 2 columns
//                         Group::make([
//                         TextInput::make('title')
//                             ->required()
//                             ->minLength(5),
//                         TextInput::make('slug')
//                             ->required()
//                             ->unique(),
//                         Select::make('category_id')
//                             ->relationship('category', 'name')
//                             ->preload()
//                             ->searchable(),
//                         ColorPicker::make('color'),
//                     ])->columns(2),
                    
//                         MarkdownEditor::make('content'),
//                     ])->columnSpan(2),
                 
//                 //Grouping fields into 2 columns
//                 Group::make([
//                 // section 2 - image
//                 Section::make('Image Upload')
//                     ->schema([
//                         FileUpload::make('image')
//                             ->disk('public')
//                             ->directory('post'),
//                     ]),

//                 // section 3 - meta
//                 Section::make('Meta Information')
//                     ->schema([
//                         TagsInput::make('tags'),
//                         Checkbox::make('published'),
//                     ])->columns(1),
//                         DateTimePicker::make('published_at'),
//                     ]),

//             ])->columns(3);
//     }
// }