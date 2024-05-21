class BaseSearchDto{
  int? pageNumber;
  int? pageSize;

  BaseSearchDto({
    int? pageNumber,
    int? pageSize,
  })  : pageNumber = pageNumber ?? 1,
        pageSize = pageSize ?? 10;

  Map<String, dynamic> toJson() {
    return {
      'pageNumber': pageNumber,
      'pageSize': pageSize,
    };
  }
}