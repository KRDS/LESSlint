<?php

class Checks_ValidCssProperty
{
	// From http://meiert.com/en/indices/css-properties/
	protected static $_properties			=	[ 'align-content', 'align-items', 'align-self', 'alignment-adjust', 'alignment-baseline', 'all', 'anchor-point', 'animation', 'animation-delay', 'animation-direction', 'animation-duration', 'animation-iteration-count', 'animation-name', 'animation-play-state', 'animation-timing-function', 'appearance', 'azimuth', 'backface-visibility', 'background', 'background-attachment', 'background-clip', 'background-color', 'background-image', 'background-origin', 'background-position', 'background-repeat', 'background-size', 'baseline-shift', 'binding', 'bleed', 'bookmark-label', 'bookmark-level', 'bookmark-state', 'bookmark-target', 'border', 'border-bottom', 'border-bottom-color', 'border-bottom-left-radius', 'border-bottom-right-radius', 'border-bottom-style', 'border-bottom-width', 'border-collapse', 'border-color', 'border-image', 'border-image-outset', 'border-image-repeat', 'border-image-slice', 'border-image-source', 'border-image-width', 'border-left', 'border-left-color', 'border-left-style', 'border-left-width', 'border-radius', 'border-right', 'border-right-color', 'border-right-style', 'border-right-width', 'border-spacing', 'border-style', 'border-top', 'border-top-color', 'border-top-left-radius', 'border-top-right-radius', 'border-top-style', 'border-top-width', 'border-width', 'bottom', 'box-decoration-break', 'box-shadow', 'box-sizing', 'break-after', 'break-before', 'break-inside', 'caption-side', 'clear', 'clip', 'color', 'color-profile', 'column-count', 'column-fill', 'column-gap', 'column-rule', 'column-rule-color', 'column-rule-style', 'column-rule-width', 'column-span', 'column-width', 'columns', 'content', 'counter-increment', 'counter-reset', 'crop', 'cue', 'cue-after', 'cue-before', 'cursor', 'direction', 'display', 'dominant-baseline', 'drop-initial-after-adjust', 'drop-initial-after-align', 'drop-initial-before-adjust', 'drop-initial-before-align', 'drop-initial-size', 'drop-initial-value', 'elevation', 'empty-cells', 'fit', 'fit-position', 'flex', 'flex-basis', 'flex-direction', 'flex-flow', 'flex-grow', 'flex-shrink', 'flex-wrap', 'float', 'float-offset', 'font', 'font-feature-settings', 'font-family', 'font-kerning', 'font-language-override', 'font-size', 'font-size-adjust', 'font-stretch', 'font-style', 'font-synthesis', 'font-variant', 'font-variant-alternates', 'font-variant-caps', 'font-variant-east-asian', 'font-variant-ligatures', 'font-variant-numeric', 'font-variant-position', 'font-weight', 'grid-cell', 'grid-column', 'grid-column-align', 'grid-column-sizing', 'grid-column-span', 'grid-columns', 'grid-flow', 'grid-row', 'grid-row-align', 'grid-row-sizing', 'grid-row-span', 'grid-rows', 'grid-template', 'hanging-punctuation', 'height', 'hyphens', 'icon', 'image-orientation', 'image-rendering', 'image-resolution', 'ime-mode', 'inline-box-align', 'justify-content', 'left', 'letter-spacing', 'line-break', 'line-height', 'line-stacking', 'line-stacking-ruby', 'line-stacking-shift', 'line-stacking-strategy', 'list-style', 'list-style-image', 'list-style-position', 'list-style-type', 'margin', 'margin-bottom', 'margin-left', 'margin-right', 'margin-top', 'marker-offset', 'marks', 'marquee-direction', 'marquee-loop', 'marquee-play-count', 'marquee-speed', 'marquee-style', 'max-height', 'max-lines', 'max-width', 'min-height', 'min-width', 'move-to', 'nav-down', 'nav-index', 'nav-left', 'nav-right', 'nav-up', 'opacity', 'order', 'orphans', 'outline', 'outline-color', 'outline-offset', 'outline-style', 'outline-width', 'overflow', 'overflow-style', 'overflow-wrap', 'overflow-x', 'overflow-y', 'padding', 'padding-bottom', 'padding-left', 'padding-right', 'padding-top', 'page', 'page-break-after', 'page-break-before', 'page-break-inside', 'page-policy', 'pause', 'pause-after', 'pause-before', 'perspective', 'perspective-origin', 'pitch', 'pitch-range', 'play-during', 'position', 'presentation-level', 'punctuation-trim', 'quotes', 'rendering-intent', 'resize', 'rest', 'rest-after', 'rest-before', 'richness', 'right', 'rotation', 'rotation-point', 'ruby-align', 'ruby-overhang', 'ruby-position', 'ruby-span', 'size', 'speak', 'speak-as', 'speak-header', 'speak-numeral', 'speak-punctuation', 'speech-rate', 'stress', 'string-set', 'tab-size', 'table-layout', 'target', 'target-name', 'target-new', 'target-position', 'text-align', 'text-align-last', 'text-decoration', 'text-decoration-color', 'text-decoration-line', 'text-decoration-skip', 'text-decoration-style', 'text-emphasis', 'text-emphasis-color', 'text-emphasis-position', 'text-emphasis-style', 'text-height', 'text-indent', 'text-justify', 'text-outline', 'text-overflow', 'text-shadow', 'text-space-collapse', 'text-transform', 'text-underline-position', 'text-wrap', 'top', 'transform', 'transform-origin', 'transform-style', 'transition', 'transition-delay', 'transition-duration', 'transition-property', 'transition-timing-function', 'unicode-bidi', 'vertical-align', 'visibility', 'voice-balance', 'voice-duration', 'voice-family', 'voice-pitch', 'voice-range', 'voice-rate', 'voice-stress', 'voice-volume', 'volume', 'white-space', 'widows', 'width', 'word-break', 'word-spacing', 'word-wrap', 'z-index', 'pointer-events', 'src' ];

	// From http://peter.sh/experiments/vendor-prefixed-css-property-overview/ (click “List”) with regex: (.*)\n to: '$1',
	protected static $_moz_properties		=	[ '-moz-appearance', '-moz-background-inline-policy', '-moz-binding', '-moz-border-bottom-colors', '-moz-border-end', '-moz-border-end-color', '-moz-border-end-style', '-moz-border-end-width', '-moz-border-left-colors', '-moz-border-right-colors', '-moz-border-start', '-moz-border-start-color', '-moz-border-start-style', '-moz-border-start-width', '-moz-border-top-colors', '-moz-box-align', '-moz-box-direction', '-moz-box-flex', '-moz-box-ordinal-group', '-moz-box-orient', '-moz-box-pack', '-moz-box-sizing', '-moz-column-count', '-moz-column-fill', '-moz-column-gap', '-moz-column-rule', '-moz-column-rule-color', '-moz-column-rule-style', '-moz-column-rule-width', '-moz-column-width', '-moz-columns', '-moz-float-edge', '-moz-font-feature-settings', '-moz-font-language-override', '-moz-force-broken-image-icon', '-moz-hyphens', '-moz-image-region', '-moz-margin-end', '-moz-margin-start', '-moz-orient', '-moz-osx-font-smoothing', '-moz-outline-radius', '-moz-outline-radius-bottomleft', '-moz-outline-radius-bottomright', '-moz-outline-radius-topleft', '-moz-outline-radius-topright', '-moz-padding-end', '-moz-padding-start', '-moz-script-level', '-moz-script-min-size', '-moz-script-size-multiplier', '-moz-stack-sizing', '-moz-tab-size', '-moz-text-align-last', '-moz-text-blink', '-moz-text-decoration-color', '-moz-text-decoration-line', '-moz-text-decoration-style', '-moz-text-size-adjust', '-moz-transform', '-moz-user-focus', '-moz-user-input', '-moz-user-modify', '-moz-user-select', '-moz-window-shadow' ];
	protected static $_webkit_properties	=	[ '-epub-caption-side', '-epub-hyphens', '-epub-text-combine', '-epub-text-emphasis', '-epub-text-emphasis-color', '-epub-text-emphasis-style', '-epub-text-orientation', '-epub-text-transform', '-epub-word-break', '-epub-writing-mode', '-webkit-align-content', '-webkit-align-items', '-webkit-align-self', '-webkit-animation', '-webkit-animation-delay', '-webkit-animation-direction', '-webkit-animation-duration', '-webkit-animation-fill-mode', '-webkit-animation-iteration-count', '-webkit-animation-name', '-webkit-animation-play-state', '-webkit-animation-timing-function', '-webkit-app-region', '-webkit-appearance', '-webkit-aspect-ratio', '-webkit-backface-visibility', '-webkit-background-blend-mode', '-webkit-background-clip', '-webkit-background-composite', '-webkit-background-origin', '-webkit-background-size', '-webkit-blend-mode', '-webkit-border-after', '-webkit-border-after-color', '-webkit-border-after-style', '-webkit-border-after-width', '-webkit-border-before', '-webkit-border-before-color', '-webkit-border-before-style', '-webkit-border-before-width', '-webkit-border-bottom-left-radius', '-webkit-border-bottom-right-radius', '-webkit-border-end', '-webkit-border-end-color', '-webkit-border-end-style', '-webkit-border-end-width', '-webkit-border-fit', '-webkit-border-horizontal-spacing', '-webkit-border-image', '-webkit-border-radius', '-webkit-border-start', '-webkit-border-start-color', '-webkit-border-start-style', '-webkit-border-start-width', '-webkit-border-top-left-radius', '-webkit-border-top-right-radius', '-webkit-border-vertical-spacing', '-webkit-box-align', '-webkit-box-decoration-break', '-webkit-box-direction', '-webkit-box-flex', '-webkit-box-flex-group', '-webkit-box-lines', '-webkit-box-ordinal-group', '-webkit-box-orient', '-webkit-box-pack', '-webkit-box-reflect', '-webkit-box-shadow', '-webkit-box-sizing', '-webkit-clip-path', '-webkit-color-correction', '-webkit-column-axis', '-webkit-column-break-after', '-webkit-column-break-before', '-webkit-column-break-inside', '-webkit-column-count', '-webkit-column-gap', '-webkit-column-progression', '-webkit-column-rule', '-webkit-column-rule-color', '-webkit-column-rule-style', '-webkit-column-rule-width', '-webkit-column-span', '-webkit-column-width', '-webkit-columns', '-webkit-cursor-visibility', '-webkit-dashboard-region', '-webkit-filter', '-webkit-flex', '-webkit-flex-basis', '-webkit-flex-direction', '-webkit-flex-flow', '-webkit-flex-grow', '-webkit-flex-shrink', '-webkit-flex-wrap', '-webkit-flow-from', '-webkit-flow-into', '-webkit-font-feature-settings', '-webkit-font-kerning', '-webkit-font-size-delta', '-webkit-font-smoothing', '-webkit-font-variant-ligatures', '-webkit-grid-auto-columns', '-webkit-grid-auto-flow', '-webkit-grid-auto-rows', '-webkit-grid-column', '-webkit-grid-column-end', '-webkit-grid-column-start', '-webkit-grid-definition-columns', '-webkit-grid-definition-rows', '-webkit-grid-row', '-webkit-grid-row-end', '-webkit-grid-row-start', '-webkit-highlight', '-webkit-hyphenate-character', '-webkit-hyphenate-limit-after', '-webkit-hyphenate-limit-before', '-webkit-hyphenate-limit-lines', '-webkit-justify-content', '-webkit-line-align', '-webkit-line-box-contain', '-webkit-line-break', '-webkit-line-clamp', '-webkit-line-grid', '-webkit-line-snap', '-webkit-locale', '-webkit-logical-height', '-webkit-logical-width', '-webkit-margin-after', '-webkit-margin-after-collapse', '-webkit-margin-before', '-webkit-margin-before-collapse', '-webkit-margin-bottom-collapse', '-webkit-margin-collapse', '-webkit-margin-end', '-webkit-margin-start', '-webkit-margin-top-collapse', '-webkit-marquee', '-webkit-marquee-direction', '-webkit-marquee-increment', '-webkit-marquee-repetition', '-webkit-marquee-speed', '-webkit-marquee-style', '-webkit-mask', '-webkit-mask-box-image', '-webkit-mask-box-image-outset', '-webkit-mask-box-image-repeat', '-webkit-mask-box-image-slice', '-webkit-mask-box-image-source', '-webkit-mask-box-image-width', '-webkit-mask-clip', '-webkit-mask-composite', '-webkit-mask-image', '-webkit-mask-origin', '-webkit-mask-position', '-webkit-mask-position-x', '-webkit-mask-position-y', '-webkit-mask-repeat', '-webkit-mask-repeat-x', '-webkit-mask-repeat-y', '-webkit-mask-size', '-webkit-max-logical-height', '-webkit-max-logical-width', '-webkit-min-logical-height', '-webkit-min-logical-width', '-webkit-nbsp-mode', '-webkit-opacity', '-webkit-order', '-webkit-overflow-scrolling', '-webkit-padding-after', '-webkit-padding-before', '-webkit-padding-end', '-webkit-padding-start', '-webkit-perspective', '-webkit-perspective-origin', '-webkit-perspective-origin-x', '-webkit-perspective-origin-y', '-webkit-print-color-adjust', '-webkit-region-break-after', '-webkit-region-break-before', '-webkit-region-break-inside', '-webkit-region-fragment', '-webkit-rtl-ordering', '-webkit-ruby-position', '-webkit-shape-inside', '-webkit-shape-margin', '-webkit-shape-outside', '-webkit-shape-padding', '-webkit-svg-shadow', '-webkit-tap-highlight-color', '-webkit-text-align-last', '-webkit-text-decoration-color', '-webkit-text-decoration-line', '-webkit-text-decoration-style', '-webkit-text-decorations-in-effect', '-webkit-text-emphasis-position', '-webkit-text-fill-color', '-webkit-text-justify', '-webkit-text-security', '-webkit-text-stroke', '-webkit-text-stroke-color', '-webkit-text-stroke-width', '-webkit-text-underline-position', '-webkit-touch-callout', '-webkit-transform', '-webkit-transform-origin', '-webkit-transform-origin-x', '-webkit-transform-origin-y', '-webkit-transform-origin-z', '-webkit-transform-style', '-webkit-transition', '-webkit-transition-delay', '-webkit-transition-duration', '-webkit-transition-property', '-webkit-transition-timing-function', '-webkit-user-drag', '-webkit-user-modify', '-webkit-user-select', '-webkit-wrap-flow', '-webkit-wrap-through' ];
	protected static $_presto_properties	=	['-apple-dashboard-region', '-o-border-image', '-o-device-pixel-ratio', '-o-focus-opacity', '-o-link', '-o-link-source', '-o-mini-fold', '-o-object-fit', '-o-object-position', '-o-tab-size', '-o-table-baseline', '-o-transform', '-o-transform-origin', '-o-transition', '-o-transition-delay', '-o-transition-duration', '-o-transition-property', '-o-transition-timing-function', '-wap-accesskey', '-wap-input-format', '-wap-input-required', '-wap-marquee-dir', '-wap-marquee-loop', '-wap-marquee-speed', '-wap-marquee-style', '-xv-interpret-as', '-xv-phonemes', '-xv-voice-balance', '-xv-voice-duration', '-xv-voice-pitch', '-xv-voice-pitch-range', '-xv-voice-rate', '-xv-voice-stress', '-xv-voice-volume' ];
	protected static $_trident_properties	=	[ '-ms-accelerator', '-ms-background-position-x', '-ms-background-position-y', '-ms-behavior', '-ms-block-progression', '-ms-content-zoom-chaining', '-ms-content-zoom-limit', '-ms-content-zoom-limit-max', '-ms-content-zoom-limit-min', '-ms-content-zoom-snap', '-ms-content-zoom-snap-points', '-ms-content-zoom-snap-type', '-ms-content-zooming', '-ms-filter', '-ms-flex', '-ms-flex-align', '-ms-flex-direction', '-ms-flex-order', '-ms-flex-pack', '-ms-flex-wrap', '-ms-flow-from', '-ms-flow-into', '-ms-grid-column', '-ms-grid-column-align', '-ms-grid-column-span', '-ms-grid-columns', '-ms-grid-row', '-ms-grid-row-align', '-ms-grid-row-span', '-ms-grid-rows', '-ms-high-contrast-adjust', '-ms-hyphenate-limit-chars', '-ms-hyphenate-limit-lines', '-ms-hyphenate-limit-zone', '-ms-hyphens', '-ms-ime-mode', '-ms-interpolation-mode', '-ms-layout-flow', '-ms-layout-grid', '-ms-layout-grid-char', '-ms-layout-grid-line', '-ms-layout-grid-mode', '-ms-layout-grid-type', '-ms-overflow-style', '-ms-overflow-x', '-ms-overflow-y', '-ms-progress-appearance', '-ms-scroll-chaining', '-ms-scroll-limit', '-ms-scroll-limit-x-max', '-ms-scroll-limit-x-min', '-ms-scroll-limit-y-max', '-ms-scroll-limit-y-min', '-ms-scroll-rails', '-ms-scroll-snap-points-x', '-ms-scroll-snap-points-y', '-ms-scroll-snap-type', '-ms-scroll-snap-x', '-ms-scroll-snap-y', '-ms-scroll-translation', '-ms-scrollbar-arrow-color', '-ms-scrollbar-base-color', '-ms-scrollbar-darkshadow-color', '-ms-scrollbar-face-color', '-ms-scrollbar-highlight-color', '-ms-scrollbar-shadow-color', '-ms-scrollbar-track-color', '-ms-text-align-last', '-ms-text-autospace', '-ms-text-justify', '-ms-text-kashida-space', '-ms-text-overflow', '-ms-text-underline-position', '-ms-touch-action', '-ms-user-select', '-ms-word-break', '-ms-word-wrap', '-ms-wrap-flow', '-ms-wrap-margin', '-ms-wrap-through', '-ms-writing-mode', '-ms-zoom', 'filter' ];

	public function check($line)
	{
		if(strpos($line, '{') === false && preg_match('#^\s*?([a-z]{1}.*?):#i', $line, $matches))
		{
			$property	=	trim($matches[1]);

			$is_valid	=	in_array($property, self::$_properties)
							|| in_array($property, self::$_moz_properties)
							|| in_array($property, self::$_webkit_properties)
							|| in_array($property, self::$_presto_properties)
							|| in_array($property, self::$_trident_properties);

			if( ! $is_valid)
				return '*'.$property.'* is not a valid property';
		}
	}
}