import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';

// React component
import CommitmentsList from '../components/commitmentsList';

const mapStateToProps = state => {
    let commitments = state.filterCoreValues.commitments;
    if (null === state.filterCoreValues.currentCoreValue) {
        commitments = [].concat.apply([], _.map(state.filterCoreValues.coreValues, (coreValue) => {
            return coreValue.commitments;
        }));
    }
    return {
        commitments: commitments,
    }
}

export default connect(mapStateToProps, null)(CommitmentsList);
