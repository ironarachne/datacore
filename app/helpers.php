<?php

use App\Models\Tag;

function inches_to_feet(int $inches): string
{
    $feetPart = floor($inches / 12);
    $inchPart = $inches % 12;

    $result = "$feetPart'$inchPart\"";

    return $result;
}

function convert_tags_to_string($object): string
{
    $tags = '';
    $tagData = $object->tags()->get();

    foreach ($tagData as $tag) {
        $tags .= $tag->name . ',';
    }

    if (substr($tags, -1, 1) == ',') {
        $tags = substr($tags, 0, -1);
    }

    return $tags;
}

function update_tags($object, string $tagData)
{
    $tags = explode(',', $tagData);
    $tagIDs = [];

    foreach ($tags as $tag) {
        $t = Tag::where('name', '=', $tag)->first();
        if (empty($t)) {
            $newTag = Tag::create(['name' => $tag]);
            $newTag->save();
            $t = $newTag;
        }
        $tagIDs[] = $t->id;
    }
    $object->tags()->sync($tagIDs);
}
