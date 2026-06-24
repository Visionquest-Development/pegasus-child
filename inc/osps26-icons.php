<?php
/**
 * Shared inline-SVG helpers for the OSPS26 templates.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'osps_modality_icon' ) ) {
	function osps_modality_icon( $key ) {
		$icons = array(
			'mammography' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a9 9 0 0 0-9 9h9z"/><path d="M12 3a9 9 0 0 1 9 9"/><circle cx="12" cy="12" r="9"/><circle cx="9" cy="14" r="1.4"/></svg>',
			'ct'          => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3.5"/><line x1="12" y1="3" x2="12" y2="6.5"/><line x1="12" y1="17.5" x2="12" y2="21"/><line x1="3" y1="12" x2="6.5" y2="12"/><line x1="17.5" y1="12" x2="21" y2="12"/></svg>',
			'mri'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12a8 8 0 0 1 16 0"/><path d="M20 12a8 8 0 0 1-16 0"/><circle cx="12" cy="12" r="2.4"/></svg>',
			'nuclear'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 9V3"/><path d="m15 13.5 5.2 3"/><path d="m9 13.5-5.2 3"/><circle cx="12" cy="12" r="9"/></svg>',
			'fluoro'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M7 18v2M17 18v2M3 9h18"/><path d="m8 13 2.5-2 2 2.5L15 11"/></svg>',
			'xray'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M2 12h20"/><circle cx="12" cy="12" r="9" stroke-dasharray="3 3"/></svg>',
		);
		return isset( $icons[ $key ] ) ? $icons[ $key ] : $icons['mammography'];
	}
}

if ( ! function_exists( 'osps_service_icon' ) ) {
	function osps_service_icon( $key ) {
		$icons = array(
			'accreditation' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>',
			'mri-safety'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
			'rso'           => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="2.2"/><path d="M12 9.8V4M12 9.8 7 17M12 9.8 17 17"/><circle cx="12" cy="12" r="9.5" stroke-opacity=".5"/></svg>',
			'facility'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14"/><path d="M9 21v-6h6v6"/><path d="M9 11h.01M15 11h.01"/></svg>',
			'advanced'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="6" width="12" height="12" rx="2"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/><path d="M10 10h4v4h-4z"/></svg>',
		);
		return isset( $icons[ $key ] ) ? $icons[ $key ] : $icons['accreditation'];
	}
}

if ( ! function_exists( 'osps_trefoil_svg' ) ) {
	function osps_trefoil_svg() {
		return '<svg viewBox="0 0 100 100"><g fill="currentColor"><path d="M 57.5 37.0 A 15 15 0 0 1 42.5 37.0 L 29.0 13.6 A 42 42 0 0 1 71.0 13.6 Z"/><path transform="rotate(120 50 50)" d="M 57.5 37.0 A 15 15 0 0 1 42.5 37.0 L 29.0 13.6 A 42 42 0 0 1 71.0 13.6 Z"/><path transform="rotate(240 50 50)" d="M 57.5 37.0 A 15 15 0 0 1 42.5 37.0 L 29.0 13.6 A 42 42 0 0 1 71.0 13.6 Z"/><circle cx="50" cy="50" r="7.5"/></g></svg>';
	}
}

if ( ! function_exists( 'osps_check_icon' ) ) {
	function osps_check_icon() {
		return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>';
	}
}

if ( ! function_exists( 'osps_badge_icon' ) ) {
	function osps_badge_icon() {
		return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="5"/><path d="m8.5 12.5-1.5 8.5 5-3 5 3-1.5-8.5"/></svg>';
	}
}

if ( ! function_exists( 'osps_contact_icon' ) ) {
	function osps_contact_icon( $key ) {
		$icons = array(
			'email'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>',
			'phone'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.86 19.86 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.86 19.86 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0 1 22 16.92z"/></svg>',
			'location' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>',
			'hours'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
			'cards'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/><line x1="6" y1="15" x2="10" y2="15"/></svg>',
			'bank'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10 12 3l9 7"/><path d="M5 10v8M9 10v8M15 10v8M19 10v8"/><line x1="2" y1="21" x2="22" y2="21"/></svg>',
			'check'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v12H6l-2 2z"/><line x1="7" y1="9" x2="17" y2="9"/><line x1="7" y1="12" x2="13" y2="12"/></svg>',
		);
		return isset( $icons[ $key ] ) ? $icons[ $key ] : $icons['email'];
	}
}

if ( ! function_exists( 'osps_visual_svg' ) ) {
	function osps_visual_svg( $key ) {
		$svgs = array(
			'check'    => '<svg viewBox="0 0 200 160" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><rect x="40" y="20" width="120" height="120" rx="10"/><line x1="62" y1="52" x2="138" y2="52"/><line x1="62" y1="74" x2="120" y2="74"/><line x1="62" y1="96" x2="138" y2="96"/><line x1="62" y1="118" x2="110" y2="118"/><circle cx="150" cy="118" r="26" fill="rgba(34,181,198,.25)" stroke="#22B5C6"/><path d="M139 118l8 8 14-16" stroke="#bfeff5"/></svg>',
			'mri'      => '<svg viewBox="0 0 200 160" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="100" cy="80" r="60"/><circle cx="100" cy="80" r="40"/><circle cx="100" cy="80" r="20" fill="rgba(34,181,198,.25)" stroke="#22B5C6"/><path d="M100 20v120M40 80h120" stroke-opacity=".5"/><text x="100" y="86" font-size="16" font-family="Archivo" font-weight="800" fill="#bfeff5" text-anchor="middle" stroke="none">MR</text></svg>',
			'trefoil'  => '<svg viewBox="0 0 200 160" fill="none"><g fill="#bfeff5" fill-opacity=".9"><g transform="translate(100,80) scale(0.9)"><path d="M 7.5 -13 A 15 15 0 0 1 -7.5 -13 L -21 -36.4 A 42 42 0 0 1 21 -36.4 Z"/><path transform="rotate(120)" d="M 7.5 -13 A 15 15 0 0 1 -7.5 -13 L -21 -36.4 A 42 42 0 0 1 21 -36.4 Z"/><path transform="rotate(240)" d="M 7.5 -13 A 15 15 0 0 1 -7.5 -13 L -21 -36.4 A 42 42 0 0 1 21 -36.4 Z"/><circle r="7.5"/></g></g><circle cx="100" cy="80" r="62" fill="none" stroke="#22B5C6" stroke-width="2" stroke-dasharray="4 6"/></svg>',
			'facility' => '<svg viewBox="0 0 200 160" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><rect x="34" y="30" width="132" height="100" rx="4"/><line x1="34" y1="80" x2="100" y2="80"/><line x1="100" y1="30" x2="100" y2="130"/><rect x="46" y="42" width="40" height="28" rx="2" fill="rgba(34,181,198,.25)" stroke="#22B5C6"/><circle cx="132" cy="60" r="14" stroke="#bfeff5"/><path d="M118 100h36M118 112h24" stroke="#bfeff5"/></svg>',
			'chip'     => '<svg viewBox="0 0 200 160" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><rect x="66" y="46" width="68" height="68" rx="8" fill="rgba(34,181,198,.18)" stroke="#22B5C6"/><rect x="86" y="66" width="28" height="28" rx="4" stroke="#bfeff5"/><path d="M84 46v-16M116 46v-16M84 114v16M116 114v16M66 80H50M66 64H50M134 80h16M134 64h16"/></svg>',
		);
		return isset( $svgs[ $key ] ) ? $svgs[ $key ] : $svgs['check'];
	}
}

if ( ! function_exists( 'osps_visual_gradient' ) ) {
	function osps_visual_gradient( $key ) {
		$map = array(
			'teal-blue'    => 'linear-gradient(150deg,var(--teal),var(--blue-700))',
			'blue-teal'    => 'linear-gradient(150deg,var(--blue),var(--teal))',
			'teal-deep'    => 'linear-gradient(150deg,var(--teal),var(--teal-900))',
			'blue7-teal'   => 'linear-gradient(150deg,var(--blue-700),var(--teal))',
			'teal-blue-2'  => 'linear-gradient(150deg,var(--teal),var(--blue))',
		);
		return isset( $map[ $key ] ) ? $map[ $key ] : $map['teal-blue'];
	}
}
