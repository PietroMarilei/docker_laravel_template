export default class LaravelUser {
    constructor(props) {
        this.user = props.auth.user;
        this.id = props.auth.user.id;
        this.roles = props.auth.roles;
        this.permissions = props.auth.permissions;
    }

    hasRole(role) {
        return this.roles.includes(role);
    }

    hasPermission(permission) {
        return this.permissions.includes(permission)
    }
}