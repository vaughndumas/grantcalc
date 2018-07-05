USE [eworkbooks]
GO

/****** Object:  Table [dbo].[gaasvc]    Script Date: 2018-07-06 9:30:02 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[gaasvc](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[unumber] [varchar](8) NOT NULL,
	[svc_start_date] [date] NOT NULL,
	[svc_end_date] [date] NULL,
	[svc_type] [varchar](8) NULL,
	[fte_ratio] [numeric](6, 4) NULL,
 CONSTRAINT [PK_gaasvc] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'gaasvc', @level2type=N'COLUMN',@level2name=N'fte_ratio'
GO

