<?php

include '../Parserus.php';

$parser = new Parserus();

echo $parser->setBBCodes([
    ['tag' => 'table',
     'type' => 'table',
     'tags_only' => true,
     'self_nesting' => 3,
     'attrs' => [
         'No_attr' => true,
         'style' => true,
         'align' => true,
         'background' => true,
         'bgcolor' => true,
         'border' => true,
         'bordercolor' => true,
         'cellpadding' => true,
         'cellspacing' => true,
         'frame' => true,
         'rules' => true,
     ],
     'handler' => function($body, $attrs) {
         $attr = '';
         foreach ($attrs as $key => $val) {
             $attr .= ' ' . $key . '="' . $val . '"';
         }
         return '<table' . $attr . '>' . $body . '</table>';
     },
    ],
    ['tag' => 'tr',
     'type' => 'tr',
     'parents' => ['table', 't'],
     'tags_only' => true,
     'self_nesting' => 3,
     'attrs' => [
         'No_attr' => true,
         'style' => true,
     ],
     'handler' => function($body, $attrs) {
         $attr = '';
         foreach ($attrs as $key => $val) {
             $attr .= ' ' . $key . '="' . $val . '"';
         }
         return '<tr' . $attr . '>' . $body . '</tr>';
     },
    ],
    ['tag' => 'th',
     'type' => 'block',
     'parents' => ['tr'],
     'self_nesting' => 3,
     'attrs' => [
         'No_attr' => true,
         'style' => true,
         'colspan' => true,
         'rowspan' => true,
     ],
     'handler' => function($body, $attrs) {
         $attr = '';
         foreach ($attrs as $key => $val) {
             $attr .= ' ' . $key . '="' . $val . '"';
         }
         return '<th' . $attr . '>' . $body . '</th>';
     },
    ],
    ['tag' => 'td',
     'type' => 'block',
     'parents' => ['tr'],
     'self_nesting' => 3,
     'attrs' => [
         'No_attr' => true,
         'style' => true,
         'colspan' => true,
         'rowspan' => true,
     ],
     'handler' => function($body, $attrs) {
         $attr = '';
         foreach ($attrs as $key => $val) {
             $attr .= ' ' . $key . '="' . $val . '"';
         }
         return '<td' . $attr . '>' . $body . '</td>';
     },
    ],
    ['tag' => 'email',
    'type' => 'email',
    'attrs' => [
        'Def' => [
            'format' => '%^[^\x00-\x1f\s]+?@[^\x00-\x1f\s]+$%',
        ],
        'No_attr' => [
            'body_format' => '%^[^\x00-\x1f\s]+?@[^\x00-\x1f\s]+$%D',
            'text_only' => true,
        ],
    ],
    'handler' => function($body, $attrs) {
        if (empty($attrs['Def'])) {
            return '<a href="mailto:' . $body . '">' . $body . '</a>';
        } else {
            return '<a href="mailto:' . $attrs['Def'] . '">' . $body . '</a>';
        }
    },
    'text_handler' => function($body, $attrs) {
        if (empty($attrs['Def'])) {
            return $body;
        } else {
            return $body . ' ' . $attrs['Def'];
        }
    },
   ],
])->parse('
[table align=right border=1 bordercolor=#ccc      cellpadding=5 cellspacing=0 style="border-collapse:collapse; width:500px"]
		[tr]
			[th style="width:50%"]Position[/th]
			[th style=width:50%]Astronaut[/th]
		[/tr]
		[tr]
			[td]Commander[/td]
			[td]Neil A. Armstrong[/td]
		[/tr]
		[tr]
			[td]Command Module Pilot[/td]
			[td]Michael Collins[/td]
		[/tr]
		[tr]
			[td]Lunar Module Pilot[/td]
			[td]Edwin "Buzz" E. Aldrin, Jr.[/td]
		[/tr]
[/table]
[email=spam@mail.ru]My email[/email]
[email]superspam@mail.ru[/email]
')->getText();

#output:
#
#Position Astronaut Commander Neil A. Armstrong Command Module Pilot Michael Collins Lunar Module Pilot Edwin "Buzz" E. Aldrin, Jr.
#My email spam@mail.ru
#superspam@mail.ru
#
