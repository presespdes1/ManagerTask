export default function ItemList({value, children, className = "", ...props}){
    return(
        <li {...props} className={`item-list ` + className}>
            {value ? value : children}
        </li>
    );
};