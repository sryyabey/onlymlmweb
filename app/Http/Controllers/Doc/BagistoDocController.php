<?php

namespace App\Http\Controllers\Doc;

use App\Http\Controllers\Controller;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BagistoDocController extends Controller
{
    public function show(Request $request)
    {
        $languages = ['en' => 'English', 'tr' => 'Türkçe', 'ru' => 'Русский', 'fr' => 'Français', 'es' => 'Español'];
        $language = $request->query('lang', 'en');
        abort_unless(is_string($language) && isset($languages[$language]), 404);

        // Keep public documentation independent of a visitor's session locale.
        app()->setLocale(in_array($language, ['en', 'tr', 'fr', 'es'], true) ? $language : 'en');
        $markdown = file_get_contents(resource_path("docs/bagisto/{$language}.md"));
        // The website supplies its own language navigation, replacing local file links.
        $markdown = preg_replace('/^\[English\].*$/m', '', $markdown);
        $html = Str::markdown($markdown, ['html_input' => 'strip', 'allow_unsafe_links' => false]);

        $document = new DOMDocument;
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8"><div id="guide-content">'.$html.'</div>');
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        $contents = [];
        foreach ($document->getElementsByTagName('h2') as $index => $heading) {
            $id = 'section-'.($index + 1);
            $heading->setAttribute('id', $id);
            $contents[] = ['id' => $id, 'title' => $heading->textContent];
        }
        foreach (iterator_to_array($document->getElementsByTagName('table')) as $index => $table) {
            $wrapper = $document->createElement('div');
            $wrapper->setAttribute('class', 'guide-table');
            $wrapper->setAttribute('tabindex', '0');
            $wrapper->setAttribute('role', 'region');
            $wrapper->setAttribute('aria-label', 'Documentation table '.($index + 1));
            $table->parentNode->replaceChild($wrapper, $table);
            $wrapper->appendChild($table);
            foreach ($table->getElementsByTagName('th') as $header) {
                $header->setAttribute('scope', 'col');
            }
        }
        foreach ($document->getElementsByTagName('pre') as $block) {
            $block->setAttribute('tabindex', '0');
        }
        $content = '';
        foreach ($document->getElementById('guide-content')->childNodes as $node) {
            $content .= $document->saveHTML($node);
        }

        return view('doc.bagisto', compact('language', 'languages', 'contents', 'content'));
    }
}
