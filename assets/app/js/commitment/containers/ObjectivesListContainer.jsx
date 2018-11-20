import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';

// React component
import ObjectivesList from '../components/objectivesList';

const mapStateToProps = state => {
    let objectives = state.filterCoreValues.objectives;
    if (null === state.filterCoreValues.currentCoreValue) {
        objectives = [].concat.apply([], _.map(state.filterCoreValues.coreValues, (coreValue) => {
            return coreValue.objectives;
        }));
    }
    return {
        objectives: objectives,
    }
}

export default connect(mapStateToProps, null)(ObjectivesList);
