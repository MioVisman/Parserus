<?php

include '../Parserus.php';

$parser = new Parserus();

$parser->setBBCodes([
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
');

print_r($parser->getIds());

#output:
#Array
#(
#    [0] => ROOT
#    [1] => TEXT
#    [2] => table
#    [3] => TEXT
#    [4] => tr
#    [5] => TEXT
#    [6] => th
#    [7] => TEXT
#    [8] => TEXT
#    [9] => th
#    [10] => TEXT
#    [11] => TEXT
#    [12] => TEXT
#    [13] => tr
#    [14] => TEXT
#    [15] => td
#    [16] => TEXT
#    [17] => TEXT
#    [18] => td
#    [19] => TEXT
#    [20] => TEXT
#    [21] => TEXT
#    [22] => tr
#    [23] => TEXT
#    [24] => td
#    [25] => TEXT
#    [26] => TEXT
#    [27] => td
#    [28] => TEXT
#    [29] => TEXT
#    [30] => TEXT
#    [31] => tr
#    [32] => TEXT
#    [33] => td
#    [34] => TEXT
#    [35] => TEXT
#    [36] => td
#    [37] => TEXT
#    [38] => TEXT
#    [39] => TEXT
#    [40] => TEXT
#)

print_r($parser->getIds('table', 'tr'));

#output:
#Array
#(
#    [2] => table
#    [4] => tr
#    [13] => tr
#    [22] => tr
#    [31] => tr
#)
