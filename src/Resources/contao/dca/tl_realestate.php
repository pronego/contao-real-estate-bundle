<?php

$GLOBALS['TL_DCA']['tl_realestate'] = [
    'config' => [
        'dataContainer' => 'Table',
        'ctable' => array('tl_realestate_objects'),
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
            'mode' => 2,
            'fields' => ['name','address'],
            'headerFields' => ['name','address'],
            'flag' => 1,
            'panelLayout' => 'debug;filter;sort,search,limit',
        ],
        'label' => [
            'fields' => ['name','address'],
            'format' => '%s',
            'showColumns' => true,
        ],
        'global_operations' => [
        ],
        'operations' => [
            'edit' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate']['edit'],
                'href' => 'table=tl_realestate_objects',
                'icon' => 'edit.gif',
            ],
            'editheader' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.gif',
            ],
            'copy' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif',
            ],
            'delete' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ],
			'toggle' => array
			(
				'label'               => array('', 'Anzeigen / Ausblenden'),//&$GLOBALS['TL_LANG']['tl_article']['toggle'],
				'icon'                => 'visible.svg',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_realestate', 'toggleIcon')
			),
            'show' => [
                'label' => &$GLOBALS['TL_LANG']['tl_realestate']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            ]
        ],
    ],
    'palettes' => [
        '__selector__' => [],
        'default' => '{header_legend},name,address,logo,image,iframe_content,pdf_path,ddd_view,ddd_view_link;{details_legend},banner,teaser,description_heading,description,slider_images,slider_links,features',
    ],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'name' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['name'],
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
        'address' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['address'],
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => [
                'maxlength' => 255,
                'tl_class' => 'w50'
            ],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'teaser' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['teaser'],
            'inputType' => 'textarea',
            'eval' => ['mandatory' => true, 'rte' => 'tinyMCE', 'helpwizard' => true, 'tl_class' => 'clr'],
            'sql' => "text NULL"
        ],
        'iframe_content' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['iframe_content'],
            'inputType' => 'text',
			'eval' => array(
				'mandatory'=>false, 
				'rgxp'=>'url', 
				'decodeEntities'=>true, 
				'maxlength'=>255, 
				'tl_class'=>'w50'
			),
			'sql' => "varchar(255) NOT NULL default ''"
        ],
        'description_heading' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['description_heading'],
            'search' => true,
            'sorting' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class' => 'clr'
            ],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'description' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['description'],
            'inputType' => 'textarea',
            'eval' => [
                'mandatory' => true,
                'rte' => 'tinyMCE',
                'helpwizard' => true
            ],
            'sql' => "text NULL"
        ],
        'features' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['features'],
            'inputType' => 'listWizard',
            'eval' => [
                'maxlength' => 60,
                'tl_class' => 'clr w50'
            ],
            'sql' => "blob NULL"
        ],
        'logo' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['logo'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => [
                'fieldType'=>'checkbox',
                'filesOnly'=>true,
                'extensions'=>Contao\Config::get('validImageTypes'),
                'tl_class' => 'w50'
            ],
            'sql' => "binary(16) NULL"
        ],
        'image' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['image'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => [
                'fieldType'=>'radio',
                'filesOnly'=>true,
                'extensions'=>Contao\Config::get('validImageTypes'),
                'tl_class' => 'w50'
            ],
            'sql' => "binary(16) NULL"
        ],
        'slider_images' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['slider_images'],
            'inputType' => 'fileTree',
            'eval' => [
                'fieldType'=>'checkbox',
                'filesOnly'=>true,
                'extensions'=>Contao\Config::get('validImageTypes'),
                'tl_class' => 'clr w50',
                'multiple' => true,
            ],
            'sql' => "blob NULL"
        ],
        'slider_links' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['slider_links'],
            'inputType' => 'listWizard',
			'eval' => array(
				'mandatory'=>false, 
				'rgxp'=>'url', 
				'decodeEntities'=>true, 
				'maxlength'=>255, 
				'tl_class'=>'w50 wizard'
			),
			'sql' => "blob NULL"
        ],
        'ddd_view' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['ddd_view'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'url',
                'maxlength' => 255,
                'dcaPicker' => true,
                'tl_class' => 'w50 wizard',
            ],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'ddd_view_link' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['ddd_view_link'],
            'exclude' => true,
            'inputType' => 'text',
            'eval' => [
                'rgxp' => 'url',
                'maxlength' => 255,
                'dcaPicker' => true,
                'tl_class' => 'w50 wizard',
            ],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'banner' => [
            'label' => &$GLOBALS['TL_LANG']['tl_realestate']['banner'],
            'inputType' => 'text',
            'eval' => [
                'maxlength' => 30,
                'tl_class' => 'w50'
            ],
            'sql' => "varchar(30) NOT NULL default ''"
        ],
		'published' => array
		(
			'label'                   => array('Veröffentlicht', ''),
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true, 'submitOnChange' => true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
    ]
];

class tl_realestate extends Backend{
	/**
	 * Return the "toggle visibility" button
	 *
	 * @param array  $row
	 * @param string $href
	 * @param string $label
	 * @param string $title
	 * @param string $icon
	 * @param string $attributes
	 *
	 * @return string
	 */ 
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		$this->import('BackendUser', 'User');

				if (strlen($this->Input->get('tid')))
		        {
		            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 0));
		            $this->redirect($this->getReferer());
		        }

		        // Check permissions AFTER checking the tid, so hacking attempts are logged
		        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_realestate::published', 'alexf'))
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
		    if (!$this->User->isAdmin && !$this->User->hasAccess('tl_realestate::published', 'alexf'))
		    {
		        $this->log('Not enough permissions to show/hide record ID "'.$intId.'"', 'tl_realestate toggleVisibility', TL_ERROR);
		        $this->redirect('contao/main.php?act=error');
		    }

		    $this->createInitialVersion('tl_realestate', $intId);

		    // Trigger the save_callback
		    if (is_array($GLOBALS['TL_DCA']['tl_realestate']['fields']['published']['save_callback']))
		    {
		        foreach ($GLOBALS['TL_DCA']['tl_realestate']['fields']['published']['save_callback'] as $callback)
		        {
		            $this->import($callback[0]);
		            $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
		        }
		    }

		    // Update the database
		    $this->Database->prepare("UPDATE tl_realestate SET tstamp=". time() .", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
		        ->execute($intId);
		    $this->createNewVersion('tl_realestate', $intId);
	}
}
