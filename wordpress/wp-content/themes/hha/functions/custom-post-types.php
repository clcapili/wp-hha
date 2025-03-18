<?php 

function register_post_template() {
    $stateInfoCenter = get_post_type_object('state-info-center');
    $stateInfoCenter -> template = 
        [
            // hero
            ['custom/hero',
                [
                    'data' => [
                        'background_color' => 'green',
                        'label' => 'STATE',
                        'link' => [
                            'title' => 'Link text',
                            'url' => '#',
                            'target' => ''
                        ],
                        'image' => 306
                    ]
                ]
            ],

            //spacer (small)
            ['core/spacer', [
                'style' => [
                    'spacing' => [
                        'height' => '100px'
                    ]
                ],
                'className' => 'is-style-small'
            ]],            

            //tabs
            ['wp-bootstrap-blocks/container', [],
                [
                    ['custom/tabs-sidebar',
                        ['data' =>
                            [
                                'tabs_0_tab_anchor' => 'overview',
                                'tabs_0_tab_name' => 'Overview',
                                '_tabs_0_tab_anchor' => 'field_6769c807c4756',
                                '_tabs_0_tab_name' => 'field_6769c807c475e',

                                'tabs_1_tab_anchor' => 'info_sessions',
                                'tabs_1_tab_name' => 'Info Sessions',
                                '_tabs_1_tab_anchor' => 'field_6769c807c4756',
                                '_tabs_1_tab_name' => 'field_6769c807c475e',

                                'tabs_2_tab_anchor' => 'training',
                                'tabs_2_tab_name' => 'Training',
                                '_tabs_2_tab_anchor' => 'field_6769c807c4756',
                                '_tabs_2_tab_name' => 'field_6769c807c475e',
                                
                                'tabs_3_tab_anchor' => 'edi_process',
                                'tabs_3_tab_name' => 'EDI Process',
                                '_tabs_3_tab_anchor' => 'field_6769c807c4756',
                                '_tabs_3_tab_name' => 'field_6769c807c475e',

                                'tabs_4_tab_anchor' => 'forms',
                                'tabs_4_tab_name' => 'Forms',
                                '_tabs_4_tab_anchor' => 'field_6769c807c4756',
                                '_tabs_4_tab_name' => 'field_6769c807c475e',

                                'tabs_5_tab_anchor' => 'faqs',
                                'tabs_5_tab_name' => 'FAQS',
                                '_tabs_5_tab_anchor' => 'field_6769c807c4756',
                                '_tabs_5_tab_name' => 'field_6769c807c475e',

                                'tabs_6_tab_anchor' => 'contact',
                                'tabs_6_tab_name' => 'Contact',
                                '_tabs_6_tab_anchor' => 'field_6769c807c4756',
                                '_tabs_6_tab_name' => 'field_6769c807c475e',

                                'tabs' => 7,
                                '_tabs' => 'field_6769c807c33fb'
                            ]
                        ],

                        [
                            ['custom/tab-pane',
                                ['data' =>
                                    [ 'first' => 1 ],

                                    'anchor' => 'overview'
                                ],

                                [
                                    ['custom/card', [
                                        'data' => [
                                            'color' => 'text-bg-yellow',
                                            'heading' => 'Important Dates',
                                            'description' => 'Important Dates lorem ipsum dolor sit amet condimentum finibus curabitur arcu massa or before 12/1/2022.'
                                        ]
                                    ]],

                                    ['core/heading', [
                                        'content' => 'Overview Headline',
                                        'level' => 2
                                    ]],
                                    
                                    ['core/paragraph', [
                                        'content' => 'Lorem ipsum dolor sit amet ac urna suspendisse donec pellentesque aptent class. Leo enim purus vestibulum volutpat ut consectetur. Nunc si bibendum feugiat sagittis letius class proin. Rhoncus porttitor sapien dictum vestibulum ornare elementum lorem tincidunt inceptos ex letius. Pretium nisl semper himenaeos hendrerit litora facilisi. Mi ultricies placerat tristique leo mollis aliquam interdum curabitur.'
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Leo commodo fringilla sodales pulvinar est. Interdum pellentesque sem posuere mattis dolor ullamcorper ridiculus aliquam pede mauris ex. Egestas facilisi suscipit nascetur libero parturient dis inceptos nisl. Commodo convallis feugiat senectus facilisis eleifend magna at venenatis dapibus nunc. Tellus ad congue curabitur donec per a. Diam taciti inceptos orci integer feugiat habitant finibus.'
                                    ]],

                                    ['core/heading', [
                                        'content' => 'Subheadline Lorem Ipsum',
                                        'level' => 3
                                    ]],

                                    ['core/list', [], [
                                        ['core/list-item', [
                                            'content' => 'Lorem ipsum dolor sit amet felis quisque curae consectetuer.'
                                        ]],

                                        ['core/list-item', [
                                            'content' => 'Ut dictumst cras taciti et habitant dui in condimentum quam primis mus.'
                                        ]],

                                        ['core/list-item', [
                                            'content' => 'Arcu convallis luctus potenti magna senectus mollis ex fringilla porta facilisis.'
                                        ]],

                                        ['core/list-item', [
                                            'content' => 'Luctus per semper torquent hendrerit vivamus non felis dolor eleifend dictumst penatibus.'
                                        ]],

                                        ['core/list-item', [
                                            'content' => 'Commodo taciti tristique auctor tempus egestas imperdiet congue vulputate ex.'
                                        ]],

                                        ['core/list-item', [
                                            'content' => 'Luctus ut posuere mi eleifend suscipit. Lacus litora vitae condimentum cubilia inceptos morbi parturient nullam.'
                                        ]]
                                    ]],

                                    ['core/heading', [
                                            'content' => 'Subheadline Lorem Ipsum',
                                            'level' => 3
                                    ]],

                                    ['core/paragraph', [
                                            'content' => '<strong>Lorem ipsum dolor sit amet massa facilisis pulvinar porttitor:</strong> nibh nunc lectus aptent orci eu sollicitudin. Pede ultricies suspendisse elementum sagittis senectus gravida ornare proin platea. Vel aptent blandit ullamcorper imperdiet scelerisque vestibulum tristique. Eu dui risus lorem pede fermentum pretium velit placerat condimentum.'
                                    ]],

                                    ['core/paragraph', [
                                            'content' => '<strong>Lectus consectetuer sem letius si eget donec:</strong> at consequat potenti phasellus in suspendisse enim auctor justo metus pulvinar. Proin tortor pretium nulla nostra feugiat. Consectetuer leo venenatis per magna enim quis rutrum natoque porttitor montes. At odio montes condimentum amet molestie lacinia torquent pellentesque sed. Amet laoreet velit himenaeos suspendisse taciti ridiculus.'
                                    ]],

                                    ['core/heading', [
                                            'content' => 'Additional Subheadline Lorem Ipsum',
                                            'level' => 3
                                    ]],

                                    [
                                        'core/paragraph', [
                                            'content' => 'For Additional information Lorem ipsum dolor sit amet per. Mauris dis donec hendrerit sociosqu nam convallis bibendum semper dictum. Sit sem pulvinar parturient quisque condimentum cursus ridiculus eleifend fusce:'
                                    ]],

                                    ['core/list', [], [
                                        ['core/list-item', [
                                            'content' => '<a href="#">Lorem Ipsum Frequently Asked Questions</a>'
                                        ]],
                                        ['core/list-item', [
                                            'content' => '<strong>Step 1:</strong> Selecting an EVV Solution that fits your provider agency'
                                        ], [
                                            ['core/list', [], [
                                                ['core/list-item', [
                                                    'content' => 'Department of Human Services has deployed an Open Model of EVV in Minnesota. Providers can choose to use the state sponsored HHAeXchange system to capture EVV at no cost OR Providers can use a 3rd Party EVV solution that meets the below requirements:'
                                                ]],
                                                ['core/list-item', [
                                                    'content' => '<strong>3rd Party Solution EVV Requirements:</strong>'
                                                ], [
                                                    ['core/list', [], [
                                                        ['core/list-item', [
                                                            'content' => 'All costs associated with 3rd Party Vendor systems are the responsibility of the Provider'
                                                        ]],
                                                        ['core/list-item', [
                                                            'content' => 'Providers must ensure their 3rd Party system connects to the HHAeXchange data system and meets state requirement'
                                                        ]]
                                                    ]]
                                                ]]
                                            ]]
                                        ]]
                                    ]]
                                    
                                    
                                ]
                            ],

                            ['custom/tab-pane',
                                ['data' =>
                                    [ 'first' => 0 ],

                                    'anchor' => 'info_sessions'
                                ],

                                [
                                    ['core/heading', [
                                        'content' => 'Info Sessions Headline',
                                        'level' => 2
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Lorem ipsum dolor sit amet inceptos dignissim venenatis eget fermentum sociosqu. Imperdiet auctor elementum feugiat consectetuer dolor nec non. Molestie iaculis finibus ornare et risus lacinia cras dictum. Class adipiscing dapibus nulla taciti aenean pellentesque in habitant nascetur ac. Eros felis diam interdum eu sit vulputate magna porttitor. Hac rutrum bibendum curabitur maecenas magnis. Tempor non feugiat porttitor netus purus natoque.'
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Ligula risus hac parturient letius morbi massa sed ullamcorper faucibus. Cubilia vitae habitasse curae pellentesque quam libero bibendum donec. Sit sed fermentum lorem auctor dis suspendisse mattis. Ut mauris ornare gravida per aliquet. Morbi venenatis hac aliquet ultricies eu purus vel quis phasellus finibus. Inceptos fusce lobortis mattis orci habitasse mauris malesuada bibendum. Molestie nostra sem sociosqu lobortis vel in. Sagittis malesuada diam aptent letius primis leo torquent taciti praesent dis.'
                                    ]]
                                ]
                            ],


                            ['custom/tab-pane',
                                ['data' =>
                                    [ 'first' => 0 ],

                                    'anchor' => 'training'
                                ],

                                [
                                    ['core/heading', [
                                        'content' => 'Upcoming Webinars',
                                        'level' => 2
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Lorem ipsum dolor sit amet molestie magnis ipsum proin ultricies. Pellentesque dui per viverra nascetur phasellus quis libero nam primis. At tortor duis habitant mauris lacus. Orci dolor consectetur arcu diam augue efficitur habitant vitae. Semper hendrerit aliquam taciti litora risus odio nisl. Himenaeos libero vel dis leo nulla feugiat pharetra justo vulputate dignissim cubilia. Libero sociosqu arcu lobortis hac in himenaeos aliquam. Laoreet iaculis lacinia suspendisse tellus per.'
                                    ]],
                                    
                                    ['core/paragraph', [
                                        'content' => 'Tortor duis nisl neque a vehicula consequat. Luctus dictum dui egestas neque taciti cursus. Commodo finibus donec sapien pellentesque tempor augue in condimentum parturient nulla suscipit. Risus euismod mollis justo torquent faucibus finibus ullamcorper lacinia. Augue faucibus dignissim class bibendum sapien suspendisse netus iaculis luctus est mi.'
                                    ]]
                                ]
                            ],


                            ['custom/tab-pane',
                                ['data' =>
                                    [ 'first' => 0 ],

                                    'anchor' => 'edi_process'
                                ],

                                [
                                    ['core/heading', [
                                        'content' => 'EDI Provider Resources',
                                        'level' => 2
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Lorem ipsum dolor sit amet molestie magnis ipsum proin ultricies. Pellentesque dui per viverra nascetur phasellus quis libero nam primis. At tortor duis habitant mauris lacus. Orci dolor consectetur arcu diam augue efficitur habitant vitae. Semper hendrerit aliquam taciti litora risus odio nisl. Himenaeos libero vel dis leo nulla feugiat pharetra justo vulputate dignissim cubilia. Libero sociosqu arcu lobortis hac in himenaeos aliquam. Laoreet iaculis lacinia suspendisse tellus per.'
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Tortor duis nisl neque a vehicula consequat. Luctus dictum dui egestas neque taciti cursus. Commodo finibus donec sapien pellentesque tempor augue in condimentum parturient nulla suscipit. Risus euismod mollis justo torquent faucibus finibus ullamcorper lacinia. Augue faucibus dignissim class bibendum sapien suspendisse netus iaculis luctus est mi.'
                                    ]]
                                ]
                            ],


                            ['custom/tab-pane',
                                ['data' =>
                                    [ 'first' => 0 ],

                                    'anchor' => 'forms'
                                ],

                                [
                                    ['core/heading', [
                                        'content' => 'Forms Headline',
                                        'level' => 2
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Lorem ipsum dolor sit amet molestie magnis ipsum proin ultricies. Pellentesque dui per viverra nascetur phasellus quis libero nam primis. At tortor duis habitant mauris lacus. Orci dolor consectetur arcu diam augue efficitur habitant vitae. Semper hendrerit aliquam taciti litora risus odio nisl. Himenaeos libero vel dis leo nulla feugiat pharetra justo vulputate dignissim cubilia. Libero sociosqu arcu lobortis hac in himenaeos aliquam. Laoreet iaculis lacinia suspendisse tellus per.'
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Tortor duis nisl neque a vehicula consequat. Luctus dictum dui egestas neque taciti cursus. Commodo finibus donec sapien pellentesque tempor augue in condimentum parturient nulla suscipit. Risus euismod mollis justo torquent faucibus finibus ullamcorper lacinia. Augue faucibus dignissim class bibendum sapien suspendisse netus iaculis luctus est mi.'
                                    ]]
                                ]
                            ],


                            ['custom/tab-pane',
                                ['data' =>
                                    [ 'first' => 0 ],

                                    'anchor' => 'faqs'
                                ],

                                [
                                    ['core/heading', [
                                        'content' => 'FAQs Headline',
                                        'level' => 2
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Lorem ipsum dolor sit amet molestie magnis ipsum proin ultricies. Pellentesque dui per viverra nascetur phasellus quis libero nam primis. At tortor duis habitant mauris lacus. Orci dolor consectetur arcu diam augue efficitur habitant vitae. Semper hendrerit aliquam taciti litora risus odio nisl. Himenaeos libero vel dis leo nulla feugiat pharetra justo vulputate dignissim cubilia. Libero sociosqu arcu lobortis hac in himenaeos aliquam. Laoreet iaculis lacinia suspendisse tellus per.'
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Tortor duis nisl neque a vehicula consequat. Luctus dictum dui egestas neque taciti cursus. Commodo finibus donec sapien pellentesque tempor augue in condimentum parturient nulla suscipit. Risus euismod mollis justo torquent faucibus finibus ullamcorper lacinia. Augue faucibus dignissim class bibendum sapien suspendisse netus iaculis luctus est mi.'
                                    ]]
                                ]
                            ],


                            ['custom/tab-pane',
                                ['data' =>
                                    [ 'first' => 0 ],

                                    'anchor' => 'contact'
                                ],

                                [
                                    ['core/heading', [
                                        'content' => 'Contact Headline',
                                        'level' => 2
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Lorem ipsum dolor sit amet molestie magnis ipsum proin ultricies. Pellentesque dui per viverra nascetur phasellus quis libero nam primis. At tortor duis habitant mauris lacus. Orci dolor consectetur arcu diam augue efficitur habitant vitae. Semper hendrerit aliquam taciti litora risus odio nisl. Himenaeos libero vel dis leo nulla feugiat pharetra justo vulputate dignissim cubilia. Libero sociosqu arcu lobortis hac in himenaeos aliquam. Laoreet iaculis lacinia suspendisse tellus per.'
                                    ]],

                                    ['core/paragraph', [
                                        'content' => 'Tortor duis nisl neque a vehicula consequat. Luctus dictum dui egestas neque taciti cursus. Commodo finibus donec sapien pellentesque tempor augue in condimentum parturient nulla suscipit. Risus euismod mollis justo torquent faucibus finibus ullamcorper lacinia. Augue faucibus dignissim class bibendum sapien suspendisse netus iaculis luctus est mi.'
                                    ]]
                                ]
                            ],

                        ]
                    ]
                ]
            ]

        ];

}
add_action('init', 'register_post_template');
