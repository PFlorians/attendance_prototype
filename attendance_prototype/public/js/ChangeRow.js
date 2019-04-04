class ChangeRow
{
    constructor({id=null, col2=null, col3=null, sh=null})
    {
        this.id=id;
        this.column2=col2;
        this.column3=col3;
        this.shift=sh;
    }
    set setId(id)
    {
        this.id=id;
    }
    set setColumn2(col2)
    {
        this.column2=col2;
    }
    set setColumn3(col3)
    {
        this.column3=col3;
    }
    set setShift(shift)
    {
        this.shift=shift;
    }
    //getters
    get getId()
    {
        return this.id;
    }
    get getColumn2()
    {
        return this.column2;
    }
    get getColumn3()
    {
        return this.column3;
    }
    get getShift()
    {
        return this.shift;
    }
}
