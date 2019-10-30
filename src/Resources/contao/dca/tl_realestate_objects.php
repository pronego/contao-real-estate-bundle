<?php

$GLOBALS['TL_DCA']['tl_realestate_objects'] = [
    'config' => [
        'dataContainer' => 'Table',
        'ptable' => 'tl_realestate',
        'ctable' => array('tl_realestate_apartments'),
        'switchToEdit' => true,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ]
        ]
    ],
    'list' => [
        'sorting' => [
            'mode' => 4,
            'fields' => ['id','name'],
            'headerFields' => ['name'],
            'flag' => 1,
            'panelLayout' => 'debug;filter;sort,search,limit',
            'child_record_callback' => array('tl_realestate_objects', 'listEntries'),
            'child_record_class' => 'no_padding',
            'disableGrouping' => true,
        ],
        'global_operations' => [
        ],
        'operations' => [
            'edit' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate_objects']['edit'],
                'href' => 'table=tl_realestate_apartments',
                'icon' => 'edit.gif',
            ],
            'editheader' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate_objects']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.gif',
            ],
            'copy' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate_objects']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif',
            ],
            'delete' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate_objects']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ],
			'toggle' => array
			(
				'label'               => array('', 'Anzeigen / Ausblenden'),//&$GLOBALS['TL_LANG']['tl_article']['toggle'],
				'icon'                => 'visible.svg',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_realestate_objects', 'toggleIcon')
			),
            'show' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate_objects']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            ]
        ],
    ],
    'palettes' => [
        '__selector__' => [],
        'default' => '{data_legend},name;{details_legend},description',
    ],
    // TODO add 'availability'
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'pid' => array
		(
			'foreignKey'              => 'tl_realestate.id',
			'sql'                     => "int(10) unsigned NOT NULL default 0",
			'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
		),
        'name' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate_objects']['name'],
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'w50'
            ],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'description' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate_objects']['description'],
            'inputType' => 'textarea',
            'eval' => [
                'rte' => 'tinyMCE',
                'helpwizard' => true
            ],
            'sql' => "text NULL"
        ],
		'published' => array
		(
			'label'                   => array('Veröffentlicht', ''),
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
    ]
];

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class tl_realestate_objects extends Backend
{
    /**
	 * Render the apartment entries for the contao admin panel
	 *
	 * @param array $arrRow
	 *
	 * @return string
	 */
	public function listEntries($arrRow)
	{
        return <<<EOF
<div class="tl_content_left">
    <ul>
        <li>{$arrRow['name']}</strong>
    </ul>
</div>
EOF;
	}
	
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		$this->import('BackendUser', 'User');

				if (strlen($this->Input->get('tid')))
		        {
		            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
		            $this->redirect($this->getReferer());
		        }

		        // Check permissions AFTER checking the tid, so hacking attempts are logged
		        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_realestate_objects::published', 'alexf'))
		        {
		            return '';
		        }
				

		        $href .= '&amp;id='.$this->Input->get('id').'&amp;tid='.$row['id'].'&amp;state='.$row[''];
				

		        if (!$row['published'])
		        {
		            $icon = 'invisible.svg';
		        }
				
				return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Disable/enable a user group
	 *
	 * @param integer       $intId
	 * @param boolean       $blnVisible
	 * @param DataContainer $dc
	 *
	 * @throws Contao\CoreBundle\Exception\AccessDeniedException
	 */
	public function toggleVisibility($intId, $blnPublished, DataContainer $dc=null)
	{
		// Check permissions to publish
		    if (!$this->User->isAdmin && !$this->User->hasAccess('tl_realestate_objects::published', 'alexf'))
		    {
		        $this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_realestate_objects toggleVisibility', TL_ERROR);
		        $this->redirect('contao/main.php?act=error');
		    }

		    $this->createInitialVersion('tl_realestate_objects', $intId);

		    // Trigger the save_callback
			print_r($GLOBALS['TL_DCA']['tl_realestate_objects']['fields']['published']);
		    if (is_array($GLOBALS['TL_DCA']['tl_realestate_objects']['fields']['published']['save_callback']))
		    {
		        foreach ($GLOBALS['TL_DCA']['tl_realestate_objects']['fields']['published']['save_callback'] as $callback)
		        {
		            $this->import($callback[0]);
		            $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
		        }
		    }

		    // Update the database
		    $this->Database->prepare("UPDATE tl_realestate_objects SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")->execute($intId);
		    $this->createNewVersion('tl_realestate_objects', $intId);
	}
}

