<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "Das Attribut :attribute soll akzeptiert sein.",
	"active_url"           => "Das Attribut :attribute ist nicht valid URL.",
	"after"                => "Das Attribut :attribute muss ein Datum sein später als :date.",
	"alpha"                => "Das Attribut :attribute soll nur Buchstaben beinhalten.",
	"alpha_dash"           => "Das Attribut :attribute soll nur Buchstaben, Ziffern und Strichen beinhalten.",
	"alpha_num"            => "Das Attribut :attribute kann nur Buchstaben und Ziffern beinhalten.",
	"array"                => "Das Attribut :attribute soll ein Feld sein.",
	"before"               => "Das Attribut :attribute muss ein Datum sein früher als :date.",
	"between"              => [
		"numeric" => "Das Attribut :attribute soll zwischen :min und :max sein.",
		"file"    => "Das Attribut :attribute soll zwischen :min und :max Kilobytes sein.",
		"string"  => "Das Attribut :attribute soll zwischen :min und :max Symbolen sein.",
		"array"   => "Das Attribut :attribute soll zwischen :min und :max Elemente sein.",
	],
	"boolean"              => "Das Attribut :attribute soll wahr oder falsch sein.",
	"confirmed"            => "Das Attribut :attribute Bestätigung ist nicht gleich.",
	"date"                 => "Das Attribut :attribute ist kein valides Datum.",
	"date_format"          => "Das Attribut :attribute folgt dem Format :format nicth.",
	"different"            => "Das Attribut :attribute und :other sollen verschieden sein.",
	"digits"               => "Das Attribut :attribute soll  :digits Symbolen sein.",
	"digits_between"       => "Das Attribut :attribute soll zwischen  :min und :max Symbolen sein.",
	"email"                => "Das Attribut :attribute soll eine valide email Adresse sein.",
	"filled"               => "Das Attribut :attribute ist obligatorisch.",
	"exists"               => "Das gewählte Attribut :attribute ist nicht valid.",
	"image"                => "Das Attribut :attribute soll ein Image sein.",
	"integer"              => "Das Attribut :attribute soll ein Integer sein.",
	"ip"                   => "Das Attribut :attribute soll eine valide IP Adresse sein.",
	"max"                  => [
		"numeric" => "Das Attribut :attribute soll nicht größer als :max sein.",
		"file"    => "Das Attribut :attribute soll nicht größer als :max Kilobytes sein.",
		"string"  => "Das Attribut :attribute soll nicht größer als :max Symbolen sein.",
		"array"   => "Das Attribut :attribute soll nicht größer alsn :max Elemente sein.",
	],
	"mimes"                => "Das Attribut :attribute must be a file of type: :values.",
	"min"                  => [
		"numeric" => "Das Attribut :attribute soll mindestens :min sein.",
		"file"    => "Das Attribut :attribute soll mindestens :min Kilobytes sein.",
		"string"  => "Das Attribut :attribute soll mindestens :min Symbolen sein.",
		"array"   => "Das Attribut :attribute soll mindestens :min Elemente sein.",
	],
	"not_in"               => "Das gewählte Attribut  :attribute ist nicht valid.",
	"numeric"              => "Das Attribut :attributesoll ein Nummer sein.",
	"regex"                => "Das Format des Attributes :attribute ist nicht valid.",
	"required"             => "Das Feld :attribute ist erforderlich.",
	"required_if"          => "Das Feld :attribute ist erforderlich wenn :other ist :value.",
	"required_with"        => "Das Feld :attribute ist erforderlich wenn :values anwesend ist.",
	"required_with_all"    => "Das Feld :attribute ist erforderlich wenn :values anwesend ist.",
	"required_without"     => "Das Feld :attribute ist erforderlich wenn :values abwesend ist.",
	"required_without_all" => "Das Feld :attribute ist erforderlich wenn keine von :values anwesend ist.",
	"same"                 => "Die Felder :attribute und :other sollen gleich sein.",
	"size"                 => [
		"numeric" => "Das Attribut :attribute soll :size sein.",
		"file"    => "Das Attribut :attribute soll :size Kilobytes sein.",
		"string"  => "Das Attribut :attribute soll :size Symbole sein.",
		"array"   => "Das Attribut :attribute soll :size Elemente sein.",
	],
	"unique"               => "Das Attribut :attribute ist schon genommen.",
	"url"                  => "Das Format des Attributes :attribute ist nicht valid.",
	"timezone"             => "Das Attribut :attribute soll eine valide Zeitzone sein.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
