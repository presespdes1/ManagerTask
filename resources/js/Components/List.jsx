export default function List({children, className = "", ...props}){
    return (       
        <ul className={` ` + className}>
            {children}
        </ul>
    );
};