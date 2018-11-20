import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';

// React component
import CoreValuesChart from '../components/coreValuesChart';

const mapStateToProps = state => {

    return {
        coreValues: state.filterCoreValues.coreValues,
        currentCoreValue: state.filterCoreValues.currentCoreValue,
        isLoading: state.filterCoreValues.isLoading,
    }
}

export default connect(mapStateToProps, null)(CoreValuesChart);
