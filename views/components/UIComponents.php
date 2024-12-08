<?php
class UIComponents {
    public function getProdutoDetailComponents($id) {
        return array(
            array(
                'key' => 'MyComponent',
                'value' => array(
                    'text' => 'Hello World'
                )
            ),
            array(
                'key' => 'CraftDTextView',
                'value' => array(
                    'text' => 'Hello World CraftD',
                    'textSize' => '40',
                    'textColorHex' => '#D977EB'
                )
            ),
            array(
                'key' => 'CraftDButton',
                'value' => array(
                    'text' => 'Some Action like this :)',
                    'align' => 'RIGHT',
                    'textAlign' => 'CENTER',
                    'textAllCaps' => true,
                    'textSize' => '20',
                    'textColorHex' => '#FFFFFF',
                    'backgroundHex' => '#2fa003',
                    'actionProperties' => array(
                        'deeplink' => 'CraftDview://any',
                        'analytics' => array(
                            'category' => 'hello',
                            'action' => 'world',
                            'label' => 'everywhere'
                        )
                    )
                )
            ),
            array(
                'key' => 'CustomBotaoFV',
                'value' => array(
                    'text' => 'Botao novo',
                    'align' => 'RIGHT',
                    'textAlign' => 'CENTER',
                    'textAllCaps' => true,
                    'textSize' => '40',
                    'textColorHex' => '#FFFFFF',
                    'backgroundHex' => '#2fa003',
                    'actionProperties' => array(
                        'deeplink' => 'CraftDview://any',
                        'analytics' => array(
                            'category' => 'hello',
                            'action' => 'world',
                            'label' => 'everywhere'
                        )
                    )
                )
            )
        );
    }
} 