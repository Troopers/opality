import React from 'react';
import ContentLoader from 'react-content-loader'

const Loader = props => (
    <ContentLoader
        rtl
        height={400}
        width={400}
        speed={2}
        primaryColor="#f3f2e6"
        secondaryColor="#e4e4ec"
        {...props}
    >
        <rect x="210" y="64" rx="4" ry="4" width="117" height="6.4" />
        <rect x="210" y="84" rx="3" ry="3" width="85" height="6.4" />
        <rect x="85.46" y="116.74" rx="3" ry="3" width="245" height="5.76" />
        <rect x="58" y="136" rx="3" ry="3" width="296.4" height="6.4" />
        <rect x="105.95" y="158.25" rx="3" ry="3" width="108.54" height="4.48" />
        <circle cx="212" cy="125" r="81" />
    </ContentLoader>
)

export default Loader;