import Avatar from "@material-ui/core/Avatar/Avatar";
import { withStyles } from '@material-ui/core/styles';
import React, {PureComponent} from "react";
import PropTypes from 'prop-types';
const styles = {
    row: {
        display: 'flex',
        justifyContent: 'center',
    },
    avatar: {
        margin: 10,
    },
};

class UserAvatar extends PureComponent {
    render() {
        const { user } = this.props;
        let title = user.firstname + ' ' + user.lastname;
        if (user.picture != null) {
            return (
                <Avatar
                    title={title}
                    alt={title}
                    src={user.picture}
                />
            );
        } else {
            return (
                <Avatar title={this.props.user.firstname + ' ' + this.props.user.lastname}>
                    {this.props.user.firstname[0] + this.props.user.lastname[0]}
                </Avatar>
            );
        }
    }
}

UserAvatar.propTypes = {
    user: PropTypes.object.isRequired
};

export default withStyles(styles)(UserAvatar);